<?php

namespace App\Notifications;

use App\Models\WeeklyReport;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewResponseAdded extends Notification
{
    use Queueable;

    public function __construct(
        public WeeklyReport $report,
        public User $responder
    ) {}

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'type'           => 'new_response',
            'responder_name' => $this->responder->name,
            'report_title'   => $this->report->title,
            'message'        => $this->responder->name . ' vừa phản hồi báo cáo "' . $this->report->title . '".',
            'link'           => route('reports.show', $this->report->id)
        ];
    }
}
