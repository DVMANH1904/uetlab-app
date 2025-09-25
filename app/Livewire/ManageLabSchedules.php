<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\LabSchedule;
use App\Models\LabStudent;

class ManageLabSchedules extends Component
{
    /**
     * Thuộc tính để liên kết với ô tìm kiếm.
     * @var string
     */
    public $search = '';

    public function deleteSchedule($scheduleId)
    {
        // Chỉ Admin mới có thể gọi hàm này (được bảo vệ bởi middleware trong route)
        $schedule = LabSchedule::find($scheduleId);
        if ($schedule) {
            $schedule->delete();
            // Component sẽ tự động re-render, không cần gọi loadSchedules()
            session()->flash('success', 'Đã xóa lịch thành công.');
        }
    }

    /**
     * Render a view with a list of students and their schedules, filtered by search term.
     */
    public function render()
    {
        $query = LabStudent::query()
            ->has('schedules') // Chỉ lấy sinh viên có đăng ký lịch
            ->with(['schedules' => function ($query) {
                // Sắp xếp các lịch của mỗi sinh viên
                $query->orderBy('day_of_week')->orderBy('start_time');
            }]);

        // Nếu có từ khóa tìm kiếm, thêm điều kiện lọc
        if (!empty($this->search)) {
            $query->where(function ($q) {
                $searchTerm = '%' . $this->search . '%';
                $q->where('name', 'like', $searchTerm)
                  ->orWhere('student_id', 'like', $searchTerm);
            });
        }

        $studentsWithSchedules = $query->get();

        return view('livewire.manage-lab-schedules', [
            'studentsWithSchedules' => $studentsWithSchedules,
        ]);
    }
}
