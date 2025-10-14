<?php

namespace App\Http\Controllers;

use App\Models\WeeklyReport;
use Illuminate\Http\Request;
use App\Models\Response;
use App\Models\User;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use App\Notifications\NewResponseAdded;
use App\Notifications\NewStudentResponse;

class ReportController extends Controller
{
    /**
     * Hiển thị danh sách báo cáo với chức năng lọc và phân trang.
     */
    public function index(Request $request)
    {
        // Bắt đầu câu truy vấn, eager load đúng quan hệ 'labStudent'
        $query = WeeklyReport::with('labStudent')->latest();

        // Xử lý lọc theo từ khóa (tiêu đề báo cáo hoặc tên sinh viên)
        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                    ->orWhereHas('labStudent', function($studentQuery) use ($searchTerm) {
                        $studentQuery->where('name', 'like', "%{$searchTerm}%");
                    });
            });
        }

        // Xử lý lọc theo trạng thái
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        $reports = $query->paginate(15);

        return view('admin.reports.index', compact('reports'));
    }

    /**
     * Hiển thị chi tiết một báo cáo cụ thể.
     */
    public function show(WeeklyReport $report)
    {
        $report->load(['labStudent.user', 'responses.user']);
        return view('reports.show', [
            'report' => $report
        ]);
    }

    /**
     * Lưu một phản hồi mới cho báo cáo và tạo thông báo tương ứng.
     */
    public function storeResponse(Request $request, WeeklyReport $report)
    {
        $request->validate([
            'response_content' => 'required|string|min:5',
        ]);

        $report->responses()->create([
            'user_id' => auth()->id(),
            'content' => $request->response_content,
        ]);

        try {
            $responder = auth()->user(); // Người phản hồi

            if ($responder->can('isAdmin')) {
                // LUỒNG 1: Admin gửi phản hồi -> Thông báo cho sinh viên
                $studentUser = $report->labStudent->user;
                if ($studentUser) {
                    $studentUser->notify(new NewResponseAdded($report, $responder));
                }
            } else {
                // LUỒNG 2: Sinh viên gửi phản hồi -> Thông báo cho tất cả Admin
                $admins = User::where('role', 'admin')->get();
                foreach ($admins as $admin) {
                    $admin->notify(new NewStudentResponse($report, $responder));
                }
            }
        } catch (\Exception $e) {
            Log::error('Lỗi khi tạo thông báo: ' . $e->getMessage());
        }

        return back()->with('success', 'Đã gửi phản hồi thành công!');
    }
    public function updateStatus(Request $request, WeeklyReport $report)
    {

        // 2. Validate dữ liệu đầu vào
        $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        // 3. Cập nhật trạng thái
        $report->update([
            'status' => $request->status
        ]);


        // 5. Quay lại trang danh sách với thông báo thành công
        return redirect()->route('admin.reports.index')->with('success', 'Cập nhật trạng thái báo cáo thành công!');
    }
}
