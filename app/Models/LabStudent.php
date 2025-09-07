<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\WeeklyReport;
class LabStudent extends Model
{
    protected $fillable = [
        'name', 'student_id', 'email', 'major',
        'join_date', 'status', 'project_topic', 'notes'
    ];
    public function weeklyReports()
    {
        return $this->hasMany(WeeklyReport::class)->orderBy('report_date', 'desc');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
