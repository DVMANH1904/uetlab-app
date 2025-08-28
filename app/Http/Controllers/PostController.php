<?php

namespace App\Http\Controllers;

// app/Http/Controllers/PostController.php
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    // Hiển thị tất cả bài đăng
    // ...
    public function index()
    {
        $posts = Post::with(['user', 'comments.user'])
                    ->withCount('likes') // Lấy số lượt thích
                    ->withExists(['likes as liked_by_user' => function ($query) {
                        $query->where('user_id', auth()->id());
                    }]) // Kiểm tra user hiện tại đã thích chưa
                    ->latest()
                    ->get();

        return view('home', compact('posts'));
    }
// ...

    // app/Http/Controllers/PostController.php
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'nullable|string',
            'media' => 'nullable|file|mimes:jpg,jpeg,png,gif,mp4,mov,ogg,qt|max:20000', // max 20MB
        ]);

        $mediaPath = null;
        $mediaType = null;

        if ($request->hasFile('media')) {
            $file = $request->file('media');
            $mediaPath = $file->store('posts', 'public');
            $mediaType = $file->getMimeType();
        }

        // Ngăn không cho đăng bài nếu không có cả nội dung và media
        if (empty($request->content) && !$mediaPath) {
            return back()->withErrors(['error' => 'Post must have content or media.']);
        }

        Auth::user()->posts()->create([
            'content' => $request->content,
            'media_path' => $mediaPath,
            'media_type' => $mediaType,
        ]);

        return redirect()->route('home');
    }

}
