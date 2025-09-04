<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\LabStudent;
use Livewire\WithPagination;

class LabStudentManager extends Component
{
    use WithPagination;

    public $search = '';

    // Thuộc tính cho modal Thêm/Sửa
    public $isModalOpen = false;
    public $studentId, $name, $student_code, $email, $major, $join_date, $status, $project_topic, $notes;

    // Thuộc tính cho modal Chi tiết
    public $isDetailModalOpen = false;
    public $selectedStudentId = null;

    public function render()
    {
        $students = LabStudent::where('name', 'like', '%'.$this->search.'%')
            ->orWhere('student_id', 'like', '%'.$this->search.'%')
            ->paginate(10);

        $selectedStudent = $this->selectedStudentId ? LabStudent::find($this->selectedStudentId) : null;

        return view('livewire.lab-student-manager', [
            'students' => $students,
            'selectedStudent' => $selectedStudent,
        ]);
    }

    public function showDetails($id)
    {
        $this->selectedStudentId = $id;
        $this->isModalOpen = false;
        $this->isDetailModalOpen = true;
    }

    public function closeDetailModal()
    {
        $this->isDetailModalOpen = false;
        $this->selectedStudentId = null;
    }

    private function resetInputFields()
    {
        $this->studentId = null;
        $this->name = '';
        $this->student_code = '';
        $this->email = '';
        $this->major = '';
        $this->join_date = '';
        $this->status = 'active';
        $this->project_topic = '';
        $this->notes = '';
    }

    public function create()
    {
        $this->resetInputFields();
        $this->closeDetailModal();
        $this->isModalOpen = true;
    }

    public function edit($id)
    {
        $student = LabStudent::findOrFail($id);

        $this->studentId = $id;
        $this->name = $student->name;
        $this->student_code = $student->student_id;
        $this->email = $student->email;
        $this->major = $student->major;
        $this->join_date = $student->join_date;
        $this->status = $student->status;
        $this->project_topic = $student->project_topic;
        $this->notes = $student->notes;

        $this->closeDetailModal();
        $this->isModalOpen = true;
    }

    public function store()
    {
        $validatedData = $this->validate([
            'name' => 'required|string|max:255',
            'student_code' => 'required|string|max:255|unique:lab_students,student_id,' . $this->studentId,
            'email' => 'required|email|max:255|unique:lab_students,email,' . $this->studentId,
            'join_date' => 'required|date',
            'major' => 'nullable|string|max:255',
            'status' => 'required|in:active,graduated,inactive',
            'project_topic' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $validatedData['student_id'] = $validatedData['student_code'];
        unset($validatedData['student_code']);

        LabStudent::updateOrCreate(['id' => $this->studentId], $validatedData);

        session()->flash('message', $this->studentId ? 'Cập nhật thành công.' : 'Thêm sinh viên thành công.');
        $this->isModalOpen = false;
        $this->resetInputFields();
    }

    public function confirmDelete($id)
    {
        LabStudent::find($id)->delete();
        session()->flash('message', 'Đã xóa sinh viên.');
    }
}
