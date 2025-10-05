<?php

namespace App\Notifications;

use App\Models\WeeklyReport;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewStudentResponse extends Notification
{
    use Queueable;

    public function __construct(
        public WeeklyReport $report,
        public User $student // Sinh viên là người phản hồi
    ) {}

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'type'           => 'new_student_response',
            'student_name'   => $this->student->name,
            'report_title'   => $this->report->title,
            'message'        => $this->student->name . ' vừa trả lời phản hồi cho báo cáo: ' . $this->report->title,
            'link'           => route('reports.show', $this->report->id)
        ];
    }
}
