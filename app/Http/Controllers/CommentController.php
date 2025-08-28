<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Post $post, Request $request)
    {
        $request->validate(['content' => 'required|string']);

        $post->comments()->create([
            'user_id' => $request->user()->id,
            'content' => $request->content,
        ]);

        return back();
    }
}
