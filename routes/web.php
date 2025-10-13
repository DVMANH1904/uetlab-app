<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Http\Controllers\WorkScheduleController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LabStudentController;
use App\Http\Controllers\StudentReportController;
use App\Http\Controllers\ReportCalendarController;
use App\Http\Controllers\LabScheduleController;
use App\Http\Controllers\TaskController;
/*
|--------------------------------------------------------------------------
| Routes công khai
|--------------------------------------------------------------------------
*/
Route::get('/lien-he', function () {
    return view('Contact.contact');
})->name('contact');

Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');
Route::get('/lich-cong-tac', [WorkScheduleController::class, 'calendarView'])->name('calendar');
Route::get('/Gioi-thieu', function () {
    return view('Introduce.overViews');
})->name('introduces');
Route::get('/Media-view', function () {
    return view('Introduce.media');
})->name('media');
Route::get('/', function () {
    return view('public.hci-lab');
})->name('hci-lab');
Route::get('/contact', function () {
    return view('public.contact');
})->name('contact');
Route::get('/blife-solution-extended', function () {
    return view('public.blife-solution-extended');
})->name('blife-solution-extended');

Route::get('/fall-detection', function () {
    return view('public.fall-detection');
})->name('fall-detection');

Route::get('/emotion-recognition-voice', function () {
    return view('public.emotion-recognition-voice');
})->name('emotion-recognition-voice');
/*
|--------------------------------------------------------------------------
| Routes cho quản trị (cần đăng nhập)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('admin')->group(function () {

    Route::get('/', function () {
        return view('Admin.admin');
    })->name('admin');

    Route::get('/students', [LabStudentController::class, 'index'])->name('students.index');
    Route::get('/Workschedule', [WorkScheduleController::class, 'index'])->name('schedule');
    Route::post('/schedule/store', [WorkScheduleController::class, 'store'])->name('admin.schedule.store');
    Route::delete('/items/{id}', [ItemController::class, 'destroy'])->name('items.destroy');
    Route::get('/media', function () {
        return view('Admin.media');
    })->name('adminmedia');
    Route::get('/student', function () {
        return view('Admin.student');
    })->name('adminstudent');
    // Media Upload
    Route::post('/media/upload', [MediaController::class, 'upload'])->name('admin.media.upload');
    Route::get('/media/list', [MediaController::class, 'list'])->name('admin.media.list');
    // Video
    Route::post('/media/upload_video', [MediaController::class, 'upload_video'])->name('admin.media.upload_video');
    Route::get('/media/list_video', [MediaController::class, 'list_video'])->name('admin.media.list_video');
    // Document
    Route::post('/media/upload_document', [MediaController::class, 'upload_document'])->name('admin.media.upload_document');
    Route::get('/media/list_document', [MediaController::class, 'list_document'])->name('admin.media.list_document');
});


/*
|--------------------------------------------------------------------------
| Routes cho người dùng đã đăng nhập
|--------------------------------------------------------------------------
*/
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/home', [PostController::class, 'index'])->name('home');
    // Route::get('/home', [PostController::class, 'index']);
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::post('/posts/{post}/like', [LikeController::class, 'store'])->name('posts.like');
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('posts.comments.store');
    Route::get('/my-reports', [StudentReportController::class, 'index'])->name('student.reports');
    Route::get('/admin/reports-calendar', [ReportCalendarController::class, 'index'])->name('admin.reports.calendar');
    Route::get('/admin/reports-calendar/data', [ReportCalendarController::class, 'data'])->name('admin.reports.data');
    Route::get('/reports/{report}', [ReportCalendarController::class, 'show'])->name('reports.show');
    Route::post('/reports/{report}/respond', [ReportCalendarController::class, 'storeResponse'])->name('reports.respond');
    Route::get('/lab-schedule', [LabScheduleController::class, 'index'])->name('lab.schedule.index');
    Route::get('/lab-schedule/events', [LabScheduleController::class, 'events'])->name('lab.schedule.events');
    Route::post('/lab-schedule', [LabScheduleController::class, 'store'])->name('lab.schedule.store');
    Route::delete('/lab-schedule/{schedule}', [LabScheduleController::class, 'destroy'])->name('lab.schedule.destroy');
    Route::get('/admin/manage-schedules', function () {
        if (! Gate::allows('isAdmin')) {
            abort(403);
        }
        return view('admin.manage-schedules');
    })->name('admin.manage.schedules');
    Route::get('/documents', function () {
        return view('documents.index');
    })->name('documents.index');
    Route::middleware(['can:isAdmin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('tasks', [TaskController::class, 'index'])->name('tasks.index'); // Xem tất cả task
        Route::get('tasks/create', [TaskController::class, 'create'])->name('tasks.create'); // Form tạo task
        Route::post('tasks', [TaskController::class, 'store'])->name('tasks.store'); // Lưu task mới
    });

    // == Routes cho Sinh viên ==
    Route::prefix('student')->name('student.')->group(function () {
        Route::get('tasks', [TaskController::class, 'myTasks'])->name('tasks.index'); // Xem task của mình
        Route::patch('tasks/{task}/update-status', [TaskController::class, 'updateStatus'])->name('tasks.updateStatus'); // Cập nhật trạng thái
    });
});
