@extends('layouts.app')
@section('title', 'Liên hệ')
@section('content')
<div class="contact">
    <div class="path">
        <a href="">TRANG CHỦ</a>
        <div>></div>
        <a href="">LIÊN HỆ</a>
    </div>
    <div class="contact-box">
        <div class="contact-title">Nếu bạn cần hỗ trợ, hãy gửi thông tin vào biểu mẫu. Chúng tôi sẽ cố gắng phản hồi sớm nhất !</div>
        <ul>
            <li>
                <div>
                    TRƯỜNG ĐẠI HỌC CÔNG NGHỆ - ĐHQGHN
                </div>
                <ul class="contact-title">
                    <li><span><ion-icon name="location-outline"></ion-icon></span>Địa chỉ: E3, 144 Xuân Thủy, Cầu Giấy, Hà Nội</li>
                    <li><span><ion-icon name="call-outline"></ion-icon></span>Điện thoại: 024.37547.461</li>
                    <li><span><ion-icon name="mail-outline"></ion-icon></span>Email: uet@vnu.edu.vn</li>
                </ul>

            </li>

            <li>
                <div>
                    GIẢNG VIÊN MA THỊ CHÂU
                </div>
                <ul class="contact-title">
                    <li><span><ion-icon name="location-outline"></ion-icon></span>Địa chỉ: 307 - E3, Phòng thí nghiệm tương tác người máy</li>
                    <li><span><ion-icon name="call-outline"></ion-icon></span>Điện thoại: 021561</li>
                    <li><span><ion-icon name="mail-outline"></ion-icon></span>Email: chaumt@vnu.edu.vn</li>
                </ul>
            </li>

            <li>
                <div>
                    QUẢN TRỊ TRANG WEB
                </div>
                <ul class="contact-title">
                    <li><span><ion-icon name="location-outline"></ion-icon></span>Địa chỉ: E3, 144 Xuân Thủy, Cầu Giấy, Hà Nội</li>
                    <li><span><ion-icon name="call-outline"></ion-icon></span>Điện thoại: 0326.849.843</li>
                    <li><span><ion-icon name="mail-outline"></ion-icon></span>Email: 20020689@vnu.edu.vn</li>
                </ul>
            </li>

        </ul>
    </div>
    <div class="feedBack">
        <div class="feedBack-title">GỬI PHẢN HỒI</div>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <form action="{{ route('feedback.store') }}" method="POST">
            @csrf
            <div class="form-group">
                {{-- Chủ đề --}}
                <div class="group-input">
                    <label for="name"><ion-icon name="document-text-outline"></ion-icon></label>
                    <select name="topic" id="topic">
                        <option selected disabled>Chủ đề bạn quan tâm</option>
                        <option value="facilities">Cơ sở vật chất và thiết bị</option>
                        <option value="procedure">Quy trình thí nghiệm</option>
                        <option value="document">Tài liệu & hướng dẫn</option>
                        <option value="other">Khác</option>
                    </select>
                </div>

                {{-- Tiêu đề --}}

                <div class="group-input">
                    <label for="name"><span><ion-icon name="clipboard-outline"></ion-icon></span></label>
                    <input type="text" id="title" name="title" placeholder="Nhập tiêu đề" required>
                </div>

                {{-- Họ và tên --}}
                <div class="group-input">
                    <label for="name"><span><ion-icon name="person-outline"></ion-icon></span></label>
                    <input type="text" id="name" name="name" placeholder="Nhập họ và tên của bạn" required>

                </div>

                {{-- Email --}}
                <div class="group-input">
                    <label for="email"><span><ion-icon name="mail-outline"></ion-icon></span></label>
                    <input type="email" id="email" name="email" placeholder="Nhập email của bạn" required>
                </div>

                {{-- Số điện thoại --}}
                <div class="group-input">
                    <label for="phone"><span><ion-icon name="call-outline"></ion-icon></span></label>
                    <input type="tel" id="phone" name="phone" placeholder="Nhập số điện thoại của bạn" required>
                </div>

                {{-- Nội dung --}}
                <textarea id="message" name="message" rows="4" placeholder="Nhập nội dung phản hồi của bạn" required></textarea>


                {{-- Nút gửi --}}
                <button type="submit" class="btn-submit">Gửi</button>
            </div>
        </form>
    </div>
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4262.075264325052!2d105.7801040757113!3d21.038243387451953!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab354920c233%3A0x5d0313a3bfdc4f37!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBDw7RuZyBuZ2jhu4csIMSQ4bqhaSBo4buNYyBRdeG7kWMgZ2lhIEjDoCBO4buZaQ!5e1!3m2!1svi!2s!4v1749107757745!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

</div>
@endsection


