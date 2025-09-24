<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\LabStudent;
use App\Models\WeeklyReport;
use App\Models\User;
use Livewire\WithFileUploads;

class StudentReportForm extends Component
{
    use WithFileUploads;

    public LabStudent $student;
    public $weeklyReports = [];

    // Thuộc tính cho form
    public $title;
    public $report_date;
    public $report_content;
    public $report_file;

    public function mount(LabStudent $student)
    {
        $this->student = $student;
        $this->loadReports();
        $this->report_date = now()->format('Y-m-d');
    }

    public function loadReports()
    {
        // Tối ưu: Sắp xếp báo cáo mới nhất lên đầu
        $this->weeklyReports = $this->student->weeklyReports()->latest()->get();
    }

    public function saveReport()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'report_date' => 'required|date',
            'report_content' => 'required|string',
            'report_file' => 'nullable|file|max:10240',
        ]);

        $filePath = null;
        if ($this->report_file) {
            $filePath = $this->report_file->store('reports', 'public');
        }

        // --- SỬA LỖI TẠI ĐÂY ---
        // Gán kết quả của hàm create() vào biến $report
        $report = $this->student->weeklyReports()->create([
            'title' => $this->title,
            'report_date' => $this->report_date,
            'content' => $this->report_content,
            'file_path' => $filePath,
        ]);

        // Giờ đây, biến $report đã tồn tại và có thể sử dụng được
        $admins = User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            $admin->notifications()->create([
                'type' => 'new_report',
                'data' => json_encode([
                    'report_id' => $report->id,
                    'report_title' => $report->title,
                    'student_name' => $this->student->name,
                ])
            ]);
        }

        session()->flash('success', 'Nộp báo cáo thành công!');
        $this->reset(['title', 'report_content', 'report_file']);
        $this->loadReports();
    }

    public function render()
    {
        return view('livewire.student-report-form');
    }
}

