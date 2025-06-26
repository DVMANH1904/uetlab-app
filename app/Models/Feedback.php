<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $fillable = [
        'topic', 'title', 'name', 'email', 'phone', 'message'
    ];
}
