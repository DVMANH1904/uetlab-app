<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Response;
use App\Models\LabStudent;
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
        'title',
        'content',
        'file_path',
        'status'
    ];

    /**
     * Định nghĩa mối quan hệ: Một báo cáo thuộc về một sinh viên.
     */
    public function labStudent()
    {
        return $this->belongsTo(LabStudent::class, 'lab_student_id');
    }

    public function responses()
    {
        // Sắp xếp để phản hồi mới nhất được hiển thị trước
        return $this->hasMany(Response::class)->latest();
    }
}
