<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'content',
        'user_id',
        'media_path',
        'media_type',
    ];

    /**
     * Get the user that owns the post.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // ...
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->latest();
    }

    // Kiểm tra xem user hiện tại đã like bài viết chưa
    public function likedBy(User $user)
    {
        return $this->likes->contains('user_id', $user->id);
    }

    public function media()
    {
        return $this->hasMany(PostMedia::class);
    }

}
