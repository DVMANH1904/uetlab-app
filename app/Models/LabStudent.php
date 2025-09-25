<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabStudent extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'student_code',
        'email',
        'user_id',
        'major',
        'join_date',
        'project_topic'
    ];

    /**
     * Lấy tài khoản người dùng được liên kết.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * Lấy tất cả các báo cáo hàng tuần của sinh viên này.
     */
    public function weeklyReports()
    {
        return $this->hasMany(WeeklyReport::class, 'lab_student_id');
    }

    
    public function schedules()
    {
        return $this->hasMany(LabSchedule::class, 'lab_student_id');
    }

}
