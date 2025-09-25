<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabSchedule extends Model
{
    use HasFactory;

    // Cập nhật lại mảng $fillable
    protected $fillable = [
        'lab_student_id',
        'title',
        'day_of_week',
        'start_time',
        'end_time',
        'start_date',
        'end_date',
    ];

    public function labStudent()
    {
        return $this->belongsTo(LabStudent::class);
    }
}