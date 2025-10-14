<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\LabStudent;
use App\Models\WeeklyReport;
use App\Models\User;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Log;
use App\Notifications\NewReportSubmitted;
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

        // Gán kết quả của hàm create() vào biến $report
        $report = $this->student->weeklyReports()->create([
            'title' => $this->title,
            'report_date' => $this->report_date,
            'content' => $this->report_content,
            'file_path' => $filePath,
        ]);

        try {
            $admins = User::where('role', 'admin')->get();
            $studentUser = $this->student->user;

            if ($studentUser) {
                foreach ($admins as $admin) {
                    $admin->notify(new NewReportSubmitted($report, $studentUser));
                }
            } else {
                Log::warning('Không tìm thấy User tương ứng với LabStudent ID: ' . $this->student->id);
            }
        } catch (\Exception $e) {
            Log::error('Lỗi khi gửi thông báo nộp báo cáo mới: ' . $e->getMessage());
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

