<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\LabStudent;
use App\Models\Post;
use App\Models\Task;
use App\Models\WeeklyReport;
use Carbon\Carbon;
use Carbon\CarbonPeriod; // Import CarbonPeriod để tạo dải ngày

class DashboardController extends Controller
{
    public function index()
    {
        // --- PHẦN ĐẾM SỐ LIỆU ---
        $postCount = Post::count();
        $taskCount = Task::count();
        $weeklyReportCount = WeeklyReport::count();
        $activeStudentCount = LabStudent::where('status', 'active')->count();
        $graduatedStudentCount = LabStudent::where('status', 'graduated')->count();
        $inactiveStudentCount = LabStudent::where('status', 'inactive')->count();

        // --- BẮT ĐẦU PHẦN CHUẨN BỊ DỮ LIỆU CHO BIỂU ĐỒ (CẬP NHẬT THEO NGÀY) ---

        // Tạo một dải ngày liên tục trong 14 ngày gần nhất
        $period = CarbonPeriod::create(Carbon::now()->subDays(13), Carbon::now());
        $dates = collect($period->toArray())->map(fn ($date) => $date->format('Y-m-d'));

        // Lấy số lượng báo cáo đã nộp, nhóm theo ngày
        $reportCounts = WeeklyReport::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('COUNT(*) as count')
            )
            ->where('created_at', '>=', Carbon::now()->subDays(14))
            ->groupBy('date')
            ->pluck('count', 'date');

        // Khớp số lượng báo cáo với dải ngày (nếu ngày nào không có sẽ là 0)
        $chartData = $dates->map(function ($date) use ($reportCounts) {
            return $reportCounts->get($date, 0);
        });

        // Tạo nhãn cho trục X (ví dụ: '17-10')
        $chartLabels = $dates->map(function ($date) {
            return Carbon::parse($date)->format('d-m');
        });

        // Truyền tất cả các biến sang view
        return view('dashboard', [
            'postCount' => $postCount,
            'taskCount' => $taskCount,
            'weeklyReportCount' => $weeklyReportCount,
            'activeStudentCount' => $activeStudentCount,
            'graduatedStudentCount' => $graduatedStudentCount,
            'inactiveStudentCount' => $inactiveStudentCount,
            'chartLabels' => $chartLabels->toJson(),
            'chartData' => $chartData->toJson(),
        ]);
    }
}

