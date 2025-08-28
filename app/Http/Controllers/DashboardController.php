<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Media; // Quan trọng: Import Media model
use App\Models\User;  // Giữ lại nếu bạn vẫn cần đếm Student

class DashboardController extends Controller
{
    public function index()
    {
        $studentCount = User::count();

        // Đếm các file có đuôi là hình ảnh
        $imageCount = Media::where('file_name', 'LIKE', '%.jpg')
                            ->orWhere('file_name', 'LIKE', '%.jpeg')
                            ->orWhere('file_name', 'LIKE', '%.png')
                            ->orWhere('file_name', 'LIKE', '%.gif')
                            ->orWhere('file_name', 'LIKE', '%.webp')
                            ->orWhere('file_name', 'LIKE', '%.svg')
                            ->count();

        // Đếm các file có đuôi là video
        $videoCount = Media::where('file_name', 'LIKE', '%.mp4')
                            ->orWhere('file_name', 'LIKE', '%.mov')
                            ->orWhere('file_name', 'LIKE', '%.avi')
                            ->orWhere('file_name', 'LIKE', '%.wmv')
                            ->count();

        // Đếm các file có đuôi là tài liệu
        $documentCount = Media::where('file_name', 'LIKE', '%.pdf')
                                ->orWhere('file_name', 'LIKE', '%.doc')
                                ->orWhere('file_name', 'LIKE', '%.docx')
                                ->orWhere('file_name', 'LIKE', '%.xls')
                                ->orWhere('file_name', 'LIKE', '%.xlsx')
                                ->orWhere('file_name', 'LIKE', '%.ppt')
                                ->orWhere('file_name', 'LIKE', '%.pptx')
                                ->count();


        // --- Truyền tất cả dữ liệu sang view ---
        return view('dashboard', compact(
            'studentCount',
            'imageCount',
            'videoCount',
            'documentCount'
        ));
    }
}
