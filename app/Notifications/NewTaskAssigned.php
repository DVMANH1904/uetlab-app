<?php

namespace App\Notifications;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewTaskAssigned extends Notification
{
    use Queueable;

    public function __construct(public Task $task) {}

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'message' => $this->task->assigner->name . ' vừa giao cho bạn task mới: ' . $this->task->title,
            'link' => route('student.tasks.index'), // Link để sinh viên bấm vào
        ];
    }
}
