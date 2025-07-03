@extends('layouts.app')
@section('title', 'Media')
@section('content')
<div class="media-bg">
    <div class="media-page">
        <div class="path">
            <a href="">GIỚI THIỆU</a>
            <div>></div>
            <a href="">TRUYỀN THÔNG</a>
        </div>
        <div class="media-header">
            <h1 class="media-title" style="color: #253b80">Truyền thông</h1>
            <p class="media-desc">
                Tổng hợp hình ảnh, video, tài liệu truyền thông về Phòng thí nghiệm Tương tác Người máy - Đại học Công nghệ, ĐHQGHN.
            </p>
        </div>
        <div class="media-grid">
            {{-- Media Item 1 --}}
            <div class="media-item">
                <img src="{{ asset('image/image-Intro/media1.jpg') }}" alt="Hình ảnh phòng thí nghiệm">
                <h3>Hình ảnh hoạt động</h3>
                <p>Những khoảnh khắc nghiên cứu, thực nghiệm và sinh hoạt tại Phòng thí nghiệm.</p>
                <a href="#" class="media-btn">Xem chi tiết</a>
            </div>
            {{-- Media Item 2 --}}
            <div class="media-item">
                <img src="{{ asset('image/image-Intro/media2.jpg') }}" alt="Hình ảnh video giới thiệu">
                <h3>Video giới thiệu</h3>
                <p>Các video về dự án, sản phẩm, sự kiện và hoạt động nổi bật của phòng thí nghiệm.</p>
                <a href="#" class="media-btn">Xem chi tiết</a>
            </div>
            {{-- Media Item 3 --}}
            <div class="media-item">
                <img src="{{ asset('image/image-Intro/media3.jpg') }}" alt="Hình ảnh bài báo, ấn phẩm khoa học">
                <h3>Tài liệu & Ấn phẩm</h3>
                <p>Các tài liệu nghiên cứu, bài báo, ấn phẩm khoa học của phòng thí nghiệm.</p>
                <a href="#" class="media-btn">Xem chi tiết</a>
            </div>
            {{-- Thêm các mục media khác nếu cần --}}
        </div>
    </div>
</div>
<style>
.path {
    width: 100%;
    height: 50px;
    display: flex;
    justify-content: center;
    align-items: center;
    text-decoration: none;
    font-weight: bold;
    font-size: 1.3rem;
}
.path div {
    margin: 0 10px;
    color: #253b80;
}
.path a {
    text-decoration: none;
    padding: 0 10px;
    color: #253b80;
}
.media-bg {
    background: #f4f6fa;
    min-height: 100vh;
    width: 100%;
    position: absolute;
    top: 140px;
}
.media-page {
    max-width: 1100px;
    margin: 0 auto;
    padding: 32px 16px;
    background: #f9f9f9;
    width: 100%;

}
.media-header {
    text-align: center;
    margin-bottom: 32px;
}
.media-title {
    font-size: 2.2rem;
    font-weight: bold;
    margin-bottom: 8px;
}
.media-desc {
    color: #555;
    font-size: 1.1rem;
}
.media-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 24px;
}
.media-item {
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.07);
    padding: 20px;
    text-align: center;
    transition: box-shadow 0.2s;
}
.media-item img {
    width: 100%;
    height: 160px;
    object-fit: cover;
    border-radius: 6px;
    margin-bottom: 14px;
}
.media-item h3 {
    font-size: 1.15rem;
    margin-bottom: 8px;
    color: #253b80;
}
.media-item p {
    font-size: 0.98rem;
    color: #666;
    margin-bottom: 14px;
}
.media-btn {
    display: inline-block;
    padding: 7px 18px;
    background: #253b80;
    color: #fff;
    border-radius: 4px;
    text-decoration: none;
    font-weight: 500;
    transition: background 0.2s;
}
.media-btn:hover {
    background: #192b60;
}
</style>
@endsection
