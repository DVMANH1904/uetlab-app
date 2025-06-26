<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\WorkSchedule; // Nếu có model WorkSchedule



class WorkScheduleController extends Controller
{
    public function index()
    {
        $schedules = WorkSchedule::all();
        return view('Admin.Workschedule', compact('schedules'));

    }

    public function calendarView()
    {
        $schedules = WorkSchedule::all();
        return view('Calendar.calendar', compact('schedules'));
    }

    public function store(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'title' => 'required',
            'time' => 'required',
            'location' => 'required',
            'manager' => 'required',
            'note' => 'nullable',
        ]);

        // Lưu vào database
        $schedule = new WorkSchedule();
        $schedule->title = $request->title;
        $schedule->time = $request->time;
        $schedule->location = $request->location;
        $schedule->manager = $request->manager;
        $schedule->note = $request->note;
        $schedule->save();

        return response()->json(['success' => true]);
    }
}
