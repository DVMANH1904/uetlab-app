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
    Route::get('/', [PostController::class, 'index'])->name('home');
    Route::get('/home', [PostController::class, 'index']);
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::post('/posts/{post}/like', [LikeController::class, 'store'])->name('posts.like');
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('posts.comments.store');
    Route::get('/my-reports', [StudentReportController::class, 'index'])->name('student.reports');
    Route::get('/admin/reports-calendar', [ReportCalendarController::class, 'index'])->name('admin.reports.calendar');
    Route::get('/admin/reports-calendar/data', [ReportCalendarController::class, 'data'])->name('admin.reports.data');
    Route::get('/reports/{report}', [ReportCalendarController::class, 'show'])->name('reports.show');
});
