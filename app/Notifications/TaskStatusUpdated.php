<?php

namespace App\Notifications;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class TaskStatusUpdated extends Notification
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
            'message' => $this->task->assignee->name . ' vừa cập nhật trạng thái task "' . $this->task->title . '".',
            'link' => route('admin.tasks.index'), // Link để admin bấm vào
        ];
    }
}
