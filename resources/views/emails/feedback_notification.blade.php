{{-- filepath: resources/views/emails/feedback_notification.blade.php --}}
<p>Bạn có phản hồi mới từ website:</p>
<ul>
    <li><strong>Chủ đề:</strong> {{ $feedback['topic'] }}</li>
    <li><strong>Tiêu đề:</strong> {{ $feedback['title'] }}</li>
    <li><strong>Họ tên:</strong> {{ $feedback['name'] }}</li>
    <li><strong>Email:</strong> {{ $feedback['email'] }}</li>
    <li><strong>SĐT:</strong> {{ $feedback['phone'] }}</li>
    <li><strong>Nội dung:</strong> {{ $feedback['message'] }}</li>
</ul>
