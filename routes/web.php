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

Route::get('/', function () {
    return view('home');
})->name('home');

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Route cho trang chủ, hiển thị bài đăng
Route::get('/home', [PostController::class, 'index'])->middleware(['auth'])->name('home');

// Route để lưu bài đăng mới
Route::post('/posts', [PostController::class, 'store'])->middleware(['auth'])->name('posts.store');
