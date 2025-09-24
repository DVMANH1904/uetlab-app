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

    public function markAsRead($notificationId = null)
    {
        if (Auth::check()) {
            $user = Auth::user();

            if ($notificationId) {
                // LUỒNG 1: Click vào một thông báo cụ thể
                $notification = $user->notifications()->find($notificationId);

                if ($notification) {
                    // 1. Đánh dấu là đã đọc
                    $notification->markAsRead();

                    // 2. Lấy ID báo cáo từ dữ liệu và chuyển hướng người dùng
                    $data = json_decode($notification->data, true);
                    
                    // Kiểm tra an toàn xem report_id có tồn tại không
                    if (isset($data['report_id'])) {
                        return redirect()->route('reports.show', $data['report_id']);
                    }
                }
            } else {
                // LUỒNG 2: Click vào nút "Đánh dấu tất cả đã đọc"
                $user->unreadNotifications->markAsRead();
                
                // Chỉ cần tải lại component để cập nhật giao diện, không chuyển hướng
                $this->loadNotifications();
            }
        }
    }

    public function render()
    {
        return view('livewire.notification-bell');
    }
}