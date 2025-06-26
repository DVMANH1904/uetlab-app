<?php

namespace App\Http\Controllers;
use App\Mail\FeedbackNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    public function store(Request $request)
    {
        // Validate dữ liệu từ form
        $validated = $request->validate([
            'topic'   => 'required',
            'title'   => 'required',
            'name'    => 'required',
            'email'   => 'required|email',
            'phone'   => 'required',
            'message' => 'required',
        ]);

        // Lưu dữ liệu vào database
        Feedback::create($validated);
        Mail::to('20020689@vnu.edu.vn')->send(new FeedbackNotification($validated));

        // Quay lại trang liên hệ với thông báo thành công
        return redirect()->route('contact')->with('success', 'Gửi phản hồi thành công!');
    }
}
