<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LabStudent; // Thêm Model LabStudent
use App\Models\Post;         // Thêm Model Post

class DashboardController extends Controller
{
    public function index()
    {
        // Đếm tổng số bài viết
        $postCount = Post::count();

        // Đếm sinh viên theo từng trạng thái
        $activeStudentCount = LabStudent::where('status', 'active')->count();
        $graduatedStudentCount = LabStudent::where('status', 'graduated')->count();
        $inactiveStudentCount = LabStudent::where('status', 'inactive')->count();

        // Truyền tất cả các biến chứa số liệu sang view
        return view('dashboard', [
            'postCount' => $postCount,
            'activeStudentCount' => $activeStudentCount,
            'graduatedStudentCount' => $graduatedStudentCount,
            'inactiveStudentCount' => $inactiveStudentCount,
        ]);
    }
}
