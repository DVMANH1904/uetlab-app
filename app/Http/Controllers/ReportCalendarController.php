<?php

namespace App\Http\Controllers;

use App\Models\WeeklyReport;
use Illuminate\Http\Request;
use App\Models\Response;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

use App\Notifications\NewResponseAdded;
use App\Notifications\NewStudentResponse;


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
        $report->load(['labStudent.user', 'responses.user']);
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
                    // SỬA ĐỔI: Gọi lớp NewResponseAdded
                    $studentUser->notify(new NewResponseAdded($report, $responder));
                }
            } else {
                // LUỒNG 2: Sinh viên gửi phản hồi -> Thông báo cho tất cả Admin
                $admins = User::where('role', 'admin')->get();
                foreach ($admins as $admin) {
                    // SỬA ĐỔI: Gọi lớp NewStudentResponse
                    $admin->notify(new NewStudentResponse($report, $responder));
                }
            }
        } catch (\Exception $e) {
            Log::error('Lỗi khi tạo thông báo: ' . $e->getMessage());
        }

        return back()->with('success', 'Đã gửi phản hồi thành công!');
    }
}
