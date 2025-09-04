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
        // Eager load the 'media' relationship
        $posts = Post::with(['user', 'comments.user', 'media'])
                    ->withCount('likes')
                    ->withExists(['likes as liked_by_user' => function ($query) {
                        $query->where('user_id', auth()->id());
                    }])
                    ->latest()
                    ->get();

        return view('home', compact('posts'));
    }

    public function store(Request $request)
    {
        // Validate for an array of files
        $request->validate([
            'content' => 'nullable|string',
            'media'   => 'nullable|array',
            'media.*' => 'file|mimes:jpg,jpeg,png,gif,mp4,mov,ogg,qt|max:20480', // 20MB Max
        ]);

        // Prevent posting if both content and media are empty
        if (empty($request->content) && !$request->hasFile('media')) {
            return back()->withErrors(['error' => 'Post must have content or media.']);
        }

        // First, create the post
        $post = Auth::user()->posts()->create([
            'content' => $request->content,
        ]);

        // If there are media files, loop through and save each one
        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $file) {
                $path = $file->store('posts', 'public');
                $post->media()->create([
                    'media_path' => $path,
                    'media_type' => $file->getMimeType(),
                ]);
            }
        }

        return redirect()->route('home');
    }
}
