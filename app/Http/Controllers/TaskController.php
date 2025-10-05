<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NewTaskAssigned;
use App\Notifications\TaskStatusUpdated;

class TaskController extends Controller
{
    // === DÀNH CHO ADMIN ===

    // Hiển thị tất cả task
    public function index()
    {
        $tasks = Task::with(['assigner', 'assignee'])->latest()->get();
        return view('admin.tasks.index', compact('tasks'));
    }

    // Hiển thị form tạo task mới
    public function create()
    {
        $students = User::where('role', 'student')->get(); // Giả sử bạn có cột 'role' trong bảng users
        return view('admin.tasks.create', compact('students'));
    }

    // Lưu task mới vào DB
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'assignee_id' => 'required|exists:users,id',
            'due_date' => 'nullable|date',
        ]);

        $task = Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'assignee_id' => $request->assignee_id,
            'due_date' => $request->due_date,
            'assigner_id' => Auth::id(), // Người giao là admin đang đăng nhập
        ]);

        $student = User::find($request->assignee_id);
        $student->notify(new NewTaskAssigned($task));
        return redirect()->route('admin.tasks.index')->with('success', 'Giao task thành công!');
    }

    // === DÀNH CHO SINH VIÊN ===

    // Hiển thị các task được giao cho sinh viên hiện tại
    public function myTasks()
    {
        $myTasks = Task::where('assignee_id', Auth::id())->with('assigner')->latest()->get();
        return view('student.tasks.index', compact('myTasks'));
    }

    // Cập nhật trạng thái task
    public function updateStatus(Request $request, Task $task)
    {
        // Đảm bảo sinh viên chỉ cập nhật task của mình
        if ($task->assignee_id !== Auth::id()) {
            abort(403);
        }

        $request->validate(['status' => 'required|in:in_progress,done']);

        $task->update(['status' => $request->status]);

        $assigner = $task->assigner;
        $assigner->notify(new TaskStatusUpdated($task));

        return back()->with('success', 'Cập nhật trạng thái thành công!');
    }
}
