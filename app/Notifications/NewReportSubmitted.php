<?php

namespace App\Notifications;

use App\Models\WeeklyReport; // <-- Sửa lại tên model báo cáo của bạn nếu cần
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewReportSubmitted extends Notification
{
    use Queueable;

    public function __construct(
        public WeeklyReport $report,
        public User $student
    ) {}

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'type'         => 'new_report',
            'student_name' => $this->student->name,
            'report_title' => $this->report->title,
            'message'      => $this->student->name . ' vừa nộp báo cáo mới: ' . $this->report->title,
            'link'         => route('reports.show', $this->report->id)
        ];
    }
}
