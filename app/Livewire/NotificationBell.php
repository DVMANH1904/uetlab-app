<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class NotificationBell extends Component
{
    public $notifications;
    public $unreadCount;

    protected $listeners = ['notificationReceived' => 'loadNotifications'];

    public function mount()
    {
        $this->loadNotifications();
    }

    public function loadNotifications()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $this->notifications = $user->notifications()->latest()->limit(10)->get();
            $this->unreadCount = $user->unreadNotifications()->count();
        } else {
            $this->notifications = collect();
            $this->unreadCount = 0;
        }
    }

    public function markAsRead($notificationId = null)
    {
        if (Auth::check()) {
            $user = Auth::user();

            if ($notificationId) {
                // LUỒNG 1: Click vào một thông báo cụ thể
                $notification = $user->notifications()->find($notificationId);

                if ($notification) {
                    $notification->markAsRead();

                    $data = $notification->data;

                    $link = $data['link'] ?? '#';

                    return redirect($link);
                }
            } else {
                // LUỒNG 2: Click vào nút "Đánh dấu tất cả đã đọc"
                $user->unreadNotifications->markAsRead();
                $this->loadNotifications(); // Tải lại để cập nhật giao diện
            }
        }
    }

    public function render()
    {
        return view('livewire.notification-bell');
    }
}

