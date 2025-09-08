<?php

namespace App\Livewire;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use App\Models\LabStudent;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Gate;
class LabStudentManager extends Component
{
    use WithPagination;

    public $search = '';

    // Thuộc tính cho modal Thêm/Sửa
    public $isModalOpen = false;
    public $studentId, $name, $student_code, $email, $major, $join_date, $status, $project_topic, $notes;
    public $password, $password_confirmation;
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
        $this->password = '';
        $this->password_confirmation = '';
        $this->roles = 'student';
    }

    public function create()
    {
        abort_if(Gate::denies('isAdmin'), 403);
        $this->resetInputFields();
        $this->closeDetailModal();
        $this->isModalOpen = true;
    }

    public function edit($id)
    {
        abort_if(Gate::denies('isAdmin'), 403);
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
        $this->role = $student->user ? $student->user->role : 'student';
        $this->closeDetailModal();
        $this->isModalOpen = true;

    }

    public function store()
    {
        abort_if(Gate::denies('isAdmin'), 403);
        // 1. Định nghĩa các quy tắc validation cơ bản
        $rules = [
            'name' => 'required|string|max:255',
            'student_code' => 'required|string|max:255|unique:lab_students,student_id,' . $this->studentId,
            'join_date' => 'required|date',
            'major' => 'nullable|string|max:255',
            'status' => 'required|in:active,graduated,inactive',
            'role' => 'required|in:admin,lecturer,student',
        ];

        // 2. Thêm validation cho email và mật khẩu tùy theo trường hợp
        if ($this->studentId) {
            // Khi CẬP NHẬT: Kiểm tra email phải là duy nhất, ngoại trừ user hiện tại
            $student = LabStudent::find($this->studentId);
            $rules['email'] = 'required|email|max:255|unique:users,email,' . $student?->user_id;
        } else {
            // Khi TẠO MỚI: Email phải là duy nhất và mật khẩu là bắt buộc
            $rules['email'] = 'required|email|max:255|unique:users,email';
            $rules['password'] = 'required|string|min:8|confirmed';
        }

        $this->validate($rules);

        // 3. Logic xử lý chính
        if ($this->studentId) {
            // --- TRƯỜNG HỢP: CẬP NHẬT SINH VIÊN ĐÃ CÓ ---
            $student = LabStudent::find($this->studentId);

            // Cập nhật thông tin trong bảng 'lab_students'
            $student->update([
                'name' => $this->name,
                'student_id' => $this->student_code,
                'major' => $this->major,
                'join_date' => $this->join_date,
                'status' => $this->status,
                // Cập nhật các trường khác...
            ]);

            // Cập nhật cả thông tin trong bảng 'users' liên quan
            if ($student->user) {
                if (auth()->id() !== $student->user()->id) {
                    $student->user()->update([
                        'role' => $this->role,
                    ]);
                }
                $student->user()->update([
                    'name' => $this->name,
                    'email' => $this->email,
                ]);
            }

            session()->flash('message', 'Cập nhật thông tin sinh viên thành công.');

        } else {
            // --- TRƯỜNG HỢP: TẠO MỚI SINH VIÊN VÀ TÀI KHOẢN ĐĂNG NHẬP ---
            // a. Tạo tài khoản User trước
            $newUser = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password), // Mã hóa mật khẩu
                'role' => 'student' // Gán vai trò mặc định
            ]);

            // b. Tạo hồ sơ LabStudent và liên kết với User vừa tạo
            $newUser->labStudentProfile()->create([
                'name' => $this->name,
                'student_id' => $this->student_code,
                'email' => $this->email, // Lưu email vào cả 2 bảng để tiện truy vấn
                'major' => $this->major,
                'join_date' => $this->join_date,
                'status' => $this->status,
            ]);

            session()->flash('message', 'Tạo tài khoản và hồ sơ sinh viên thành công.');
        }

        // 4. Đóng modal và reset form
        $this->isModalOpen = false;
        $this->resetInputFields();
    }
    public function confirmDelete($id)
    {
        abort_if(Gate::denies('isAdmin'), 403);
        LabStudent::find($id)->delete();
        session()->flash('message', 'Đã xóa sinh viên.');
    }
}
