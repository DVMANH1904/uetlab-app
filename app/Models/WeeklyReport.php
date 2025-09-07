<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeeklyReport extends Model
{
    use HasFactory;

    /**
     * Các thuộc tính được phép gán hàng loạt.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'lab_student_id',
        'report_date',
        'content',
        'file_path'
    ];

    /**
     * Định nghĩa mối quan hệ: Một báo cáo thuộc về một sinh viên.
     */
    public function labStudent()
    {
        return $this->belongsTo(LabStudent::class);
    }
}
