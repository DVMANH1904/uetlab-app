<?php
use App\Http\Controllers\WorkScheduleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/lien-he', function () {
    return view('Contact.contact');
})->name('contact');

use App\Http\Controllers\FeedbackController;

Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');

Route::get('/lich-cong-tac', function () {
    return view('Calendar.calendar');
})->name('calendar');

Route::get('/Admin', function () {
    return view('Admin.admin');
})->name('admin');
Route::get('/Workschedule', function () {
    return view('Admin.Workschedule');
})->name('shedule');

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

Route::post('/custom-logout', function(Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/Login/index.php');
});

// routes/web.php
Route::post('/admin/schedule/store', [WorkScheduleController::class, 'store'])->name('admin.schedule.store');

Route::get('/Workschedule', [WorkScheduleController::class, 'index'])->name('shedule');
Route::get('/lich-cong-tac', [WorkScheduleController::class, 'calendarView'])->name('calendar');

Route::delete('/items/{id}', [ItemController::class, 'destroy'])->name('items.destroy');

Route::get('/Gioi-thieu', function () {
    return view('Introduce.overViews');
})->name('introduces');

Route::get('/Media-view', function () {
    return view('Introduce.media');
})->name('media');
Route::get('/admin-Media', function () {
    return view('Admin.media');
})->name('adminmedia');

Route::post('/admin/media/upload', [App\Http\Controllers\Admin\MediaController::class, 'upload'])->name('admin.media.upload');
Route::get('/admin/media/list', [App\Http\Controllers\Admin\MediaController::class, 'list'])->name('admin.media.list');

Route::post('/admin/media/upload_video', [App\Http\Controllers\Admin\MediaController::class, 'upload_video'])->name('admin.media.upload_video');
Route::get('/admin/media/list_video', [App\Http\Controllers\Admin\MediaController::class, 'list_video'])->name('admin.media.list_video');

Route::post('/admin/media/upload_document', [App\Http\Controllers\Admin\MediaController::class, 'upload_document'])->name('admin.media.upload_document');
Route::get('/admin/media/list_document', [App\Http\Controllers\Admin\MediaController::class, 'list_document'])->name('admin.media.list_document');
