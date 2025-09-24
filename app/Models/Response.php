<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    use HasFactory;

    /**
     * Các thuộc tính được phép gán hàng loạt (mass assignment).
     * Điều này là bắt buộc để phương thức create() hoạt động.
     * @var array<int, string>
     */
    protected $fillable = [
        'weekly_report_id',
        'user_id',
        'content',
    ];

    /**
     * Định nghĩa mối quan hệ "belongsTo":
     * Một Response (phản hồi) thuộc về một WeeklyReport (báo cáo).
     */
    public function weeklyReport()
    {
        return $this->belongsTo(WeeklyReport::class);
    }

    /**
     * Định nghĩa mối quan hệ "belongsTo":
     * Một Response (phản hồi) được tạo bởi một User (người dùng).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}