<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LabSchedule;
use Illuminate\Support\Facades\Auth;
use Carbon\CarbonPeriod;

class LabScheduleController extends Controller
{
    public function index()
    {
        return view('lab-schedule.index');
    }

    public function events(Request $request)
    {
        $user = Auth::user();
        $events = [];

        if ($user->can('isAdmin')) {
            $rules = LabSchedule::with('labStudent')->get();
        } else {
            $labStudent = $user->labStudentProfile;
            if (!$labStudent) {
                return response()->json([]);
            }
            $rules = $labStudent->schedules()->get();
        }

        foreach ($rules as $rule) {
            $period = CarbonPeriod::create($rule->start_date, $rule->end_date);
            foreach ($period as $date) {
                if ($date->dayOfWeek == $rule->day_of_week) {
                    $events[] = [
                        'id'    => $rule->id,
                        'title' => $user->can('isAdmin') ? $rule->labStudent->name : $rule->title,
                        'start' => $date->format('Y-m-d') . 'T' . $rule->start_time,
                        'end'   => $date->format('Y-m-d') . 'T' . $rule->end_time,
                        'extendedProps' => [
                            'purpose' => $rule->title,
                            'student_name' => optional($rule->labStudent)->name,
                        ]
                    ];
                }
            }
        }

        return response()->json($events);
    }

    /**
     * Lưu một quy tắc lặp lại mới (với logic kiểm tra trùng lặp cho chính người dùng).
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'day_of_week' => 'required|integer|between:0,6',
            'start_time'  => 'required|date_format:H:i',
            'end_time'    => 'required|date_format:H:i|after:start_time',
            'end_date'    => 'required|date|after_or_equal:today',
        ]);

        $labStudent = Auth::user()->labStudentProfile;
        if (!$labStudent) {
            return response()->json(['message' => 'Tài khoản của bạn chưa được liên kết.'], 403);
        }

        // kiểm tra xung đột với các lịch hiện có của chính sinh viên này
        $existing = LabSchedule::where('lab_student_id', $labStudent->id)
            ->where('day_of_week', $request->day_of_week)
            ->where('end_date', '>=', now()->format('Y-m-d'))
            ->where(function($query) use ($request) {
                $query->where('start_time', '<', $request->end_time)
                      ->where('end_time', '>', $request->start_time);
            })->exists();

        if ($existing) {
            return response()->json(['message' => 'Lịch bạn chọn đã bị trùng với một lịch cố định khác của chính bạn.'], 409);
        }
        

        $schedule = LabSchedule::create([
            'lab_student_id' => $labStudent->id,
            'title'          => $request->title,
            'day_of_week'    => $request->day_of_week,
            'start_time'     => $request->start_time,
            'end_time'       => $request->end_time,
            'start_date'     => now()->format('Y-m-d'),
            'end_date'       => $request->end_date,
        ]);

        return response()->json($schedule);
    }

    public function destroy(LabSchedule $schedule)
    {
        $labStudentId = optional(Auth::user()->labStudentProfile)->id;
        if (Auth::user()->can('isAdmin') || $schedule->lab_student_id === $labStudentId) {
            $schedule->delete();
            return response()->json(['message' => 'Đã xóa lịch cố định thành công.']);
        }
        
        return response()->json(['message' => 'Bạn không có quyền thực hiện hành động này.'], 403);
    }
}

