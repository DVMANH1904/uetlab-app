<?php

namespace App\Http\Controllers;

// app/Http/Controllers/LikeController.php
use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Post $post, Request $request)
    {
        $user = $request->user();
        $hasLiked = $post->likedBy($user);

        if ($hasLiked) {
            $user->likes()->where('post_id', $post->id)->delete();
        } else {
            $post->likes()->create(['user_id' => $user->id]);
        }

        // Trả về dữ liệu JSON để Alpine.js cập nhật giao diện
        return response()->json([
            'liked' => !$hasLiked,
            'likes_count' => $post->likes()->count(),
        ]);
    }
}
