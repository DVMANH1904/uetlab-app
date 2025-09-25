<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'original_filename',
        'file_path',
        'file_type',
        'file_size',
    ];

    /**
     * Lấy thông tin người dùng đã tải tài liệu lên.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}