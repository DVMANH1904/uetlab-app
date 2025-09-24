<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class NotificationBell extends Component
{
    public $notifications;
    public $unreadCount;

    // Sử dụng listeners để tự động refresh component khi có sự kiện mới
    protected $listeners = ['notificationReceived' => 'loadNotifications'];

    public function mount()
    {
        $this->loadNotifications();
    }

    public function loadNotifications()
    {
        if (Auth::check()) {
            $user = Auth::user();
            // Lấy 10 thông báo mới nhất
            $this->notifications = $user->notifications()->latest()->limit(10)->get();
            // Đếm số thông báo chưa đọc
            $this->unreadCount = $user->unreadNotifications()->count();
        } else {
            $this->notifications = collect(); // Trả về một collection rỗng nếu chưa đăng nhập
            $this->unreadCount = 0;
        }
    }

    public function markAsRead()
    {
        if (Auth::check()) {
            Auth::user()->unreadNotifications->markAsRead();
            $this->loadNotifications(); // Tải lại để cập nhật count về 0
        }
    }

    public function render()
    {
        return view('livewire.notification-bell');
    }
}