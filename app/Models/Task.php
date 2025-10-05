<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'assigner_id',
        'assignee_id',
        'due_date',
        'status',
    ];

    // Mối quan hệ: Task này thuộc về người giao (assigner)
    public function assigner()
    {
        return $this->belongsTo(User::class, 'assigner_id');
    }

    // Mối quan hệ: Task này được giao cho (assignee)
    public function assignee()
    {
        return $this->belongsTo(User::class, 'assignee_id');
    }
}
