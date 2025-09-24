<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WeeklyReport;
use App\Models\User;   // Giả sử bạn có model User

class ReportCalendarController extends Controller
{

    public function index()
    {
        return view('admin.reports-calendar');
    }
    public function show(WeeklyReport $report)
    {
        // Laravel đã tự động tìm báo cáo cho bạn dựa vào ID trên URL.
        // Giờ chỉ cần trả về view và truyền đối tượng $report qua.
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

        $events = [];
        foreach ($reports as $report) {
            $events[] = [
                'title'           => $report->labStudent->name,
                'start'           => $report->created_at,
                'url'             => route('reports.show', $report->id),
                'backgroundColor' => '#E6F0FF', 
                'borderColor'     => '#B3D1FF',
                'textColor'       => '#0A3D91',
            ];
        }
        return response()->json($events);
    }
    public function storeResponse(Request $request, WeeklyReport $report)
    {
        // 1. Xác thực dữ liệu
        $request->validate([
            'response_content' => 'required|string|min:5',
        ], [
            'response_content.required' => 'Vui lòng nhập nội dung phản hồi.',
            'response_content.min' => 'Nội dung phản hồi cần ít nhất 5 ký tự.',
        ]);

        // 2. Tạo và lưu phản hồi mới
        $report->responses()->create([
            'user_id' => auth()->id(),
            'content' => $request->response_content,
        ]);

        // 3. Quay trở lại trang chi tiết với thông báo thành công
        return back()->with('success', 'Đã gửi phản hồi thành công!');
    }
}