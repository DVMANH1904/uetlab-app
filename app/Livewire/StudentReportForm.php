<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\LabStudent;
use App\Models\WeeklyReport;
use Livewire\WithFileUploads;

class StudentReportForm extends Component
{
    use WithFileUploads;

    public LabStudent $student;
    public $title;
    public $weeklyReports = [];

    // Thuộc tính cho form
    public $report_date;
    public $report_content;
    public $report_file;

    // Hàm mount() sẽ được gọi khi component được khởi tạo
    public function mount(LabStudent $student)
    {
        $this->student = $student;
        $this->loadReports();
        $this->report_date = now()->format('Y-m-d');
    }

    public function loadReports()
    {
        $this->weeklyReports = $this->student->weeklyReports()->get();
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

        $this->student->weeklyReports()->create([
            'title' => $this->title,
            'report_date' => $this->report_date,
            'content' => $this->report_content,
            'file_path' => $filePath,
        ]);

        session()->flash('message', 'Nộp báo cáo thành công!');
        $this->reset(['report_content', 'report_file']);
        $this->loadReports();
    }

    public function render()
    {
        return view('livewire.student-report-form');
    }
}
