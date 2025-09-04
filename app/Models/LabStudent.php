<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LabStudent extends Model
{
    protected $fillable = [
        'name', 'student_id', 'email', 'major',
        'join_date', 'status', 'project_topic', 'notes'
    ];
}
