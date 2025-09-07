<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentReportController extends Controller
{
    public function index()
    {
        // Lấy thông tin sinh viên của user đang đăng nhập
        $labStudent = Auth::user()->labStudentProfile;

        // Truyền thông tin đó sang view
        return view('student.reports', compact('labStudent'));
    }
}
