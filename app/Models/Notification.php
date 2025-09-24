<?php

namespace App\Models;

// THÊM DÒNG NÀY
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Notifications\DatabaseNotification;

class Notification extends DatabaseNotification
{

    use HasUuids;

    /**
     * The connection name for the model.
     *
     * @var string|null
     */
    protected $connection = 'mysql'; // Hoặc tên connection database của bạn
}