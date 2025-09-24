<?php

namespace App\Http\Controllers;

use App\Models\WeeklyReport;
use Illuminate\Http\Request;
use App\Models\Response;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log; // << THÊM DÒNG NÀY

class ReportCalendarController extends Controller
{
    /**
     * Hiển thị trang lịch báo cáo.
     */
    public function index()
    {
        return view('admin.reports-calendar');
    }

    /**
     * Hiển thị chi tiết một báo cáo cụ thể.
     */
    public function show(WeeklyReport $report)
    {
        // Tải trước các dữ liệu liên quan để tối ưu truy vấn
        $report->load(['labStudent.user', 'responses.user']);

        // Trả về view 'reports.show' và truyền đối tượng $report qua
        return view('reports.show', [
            'report' => $report
        ]);
    }

    /**
     * Cung cấp dữ liệu báo cáo dưới dạng JSON cho FullCalendar.
     */
    public function data()
    {
        $reports = WeeklyReport::with('labStudent')->get();

        $events = $reports->map(function ($report) {
            return [
                'title'           => $report->labStudent->name ?? 'N/A',
                'start'           => $report->created_at->toIso8601String(),
                'url'             => route('reports.show', $report->id),
                'backgroundColor' => '#E6F0FF',
                'borderColor'     => '#B3D1FF',
                'textColor'       => '#0A3D91',
            ];
        });

        return response()->json($events);
    }
    
    /**
     * Lưu một phản hồi mới cho báo cáo và tạo thông báo tương ứng.
     */
    public function storeResponse(Request $request, WeeklyReport $report)
    {
        $request->validate([
            'response_content' => 'required|string|min:5',
        ]);

        // 1. Luôn lưu phản hồi mới vào database, đây là chức năng chính
        $report->responses()->create([
            'user_id' => auth()->id(),
            'content' => $request->response_content,
        ]);

        // 2. Cố gắng tạo thông báo, nhưng nếu thất bại cũng không sao
        try {
            $user = auth()->user();
            // TẠO TIÊU ĐỀ DỰ PHÒNG, GIẢI QUYẾT LỖI THIẾU TIÊU ĐỀ
            $reportTitle = $report->title ?? 'Báo cáo nộp ngày ' . $report->created_at->format('d/m/Y');
            
            if ($user->can('isAdmin')) {
                // LUỒNG 1: Admin gửi phản hồi -> Thông báo cho sinh viên
                $labStudent = $report->labStudent;
                if ($labStudent && $labStudent->user) {
                    $studentUser = $labStudent->user;
                    $studentUser->notifications()->create([
                        'type' => 'new_response',
                        'data' => json_encode([
                            'report_id' => $report->id,
                            'report_title' => $reportTitle,
                            'responder_name' => $user->name,
                        ])
                    ]);
                }
            } else {
                // LUỒNG 2: Sinh viên gửi phản hồi -> Thông báo cho tất cả Admin
                $admins = User::where('role', 'admin')->get();
                foreach ($admins as $admin) {
                    $admin->notifications()->create([
                        'type' => 'new_student_response',
                        'data' => json_encode([
                            'report_id' => $report->id,
                            'report_title' => $reportTitle,
                            'student_name' => $user->name,
                        ])
                    ]);
                }
            }
        } catch (\Exception $e) {
            Log::error('Lỗi khi tạo thông báo: ' . $e->getMessage());
        }
        
        // 3. Luôn chuyển hướng về trang trước với thông báo thành công
        return back()->with('success', 'Đã gửi phản hồi thành công!');
    }
}

