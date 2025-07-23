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
                <a href="#" class="media-btn" id="show-image-gallery">Xem chi tiết</a>
            </div>
            {{-- Media Item 2 --}}
            <div class="media-item">
                <img src="{{ asset('image/image-Intro/media2.jpg') }}" alt="Hình ảnh video giới thiệu">
                <h3>Video giới thiệu</h3>
                <p>Các video về dự án, sản phẩm, sự kiện và hoạt động nổi bật của phòng thí nghiệm.</p>
                <a href="#" class="media-btn" id="show-video-gallery">Xem chi tiết</a>
            </div>
            {{-- Media Item 3 --}}
            <div class="media-item">
                <img src="{{ asset('image/image-Intro/media3.jpg') }}" alt="Hình ảnh bài báo, ấn phẩm khoa học">
                <h3>Tài liệu & Ấn phẩm</h3>
                <p>Các tài liệu nghiên cứu, bài báo, ấn phẩm khoa học của phòng thí nghiệm.</p>
                <a href="#" class="media-btn" id="show-document-gallery">Xem chi tiết</a>
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

{{-- Modal image Gallery --}}
<div id="image-gallery-modal" style="display:none;position:fixed;z-index:10001;top:0;left:0;width:100vw;height:100vh;background:rgba(0,0,0,0.85);align-items:center;justify-content:center;">
    <div style="background:#fff;border-radius:18px;box-shadow:0 8px 32px rgba(0,0,0,0.19);max-width:700px;max-height:90vh;display:flex;flex-direction:column;align-items:center;position:relative;padding:0;">
        <button id="image-gallery-close" style="position:absolute;top:10px;right:10px;width:38px;height:38px;background:none;border:none;font-size:1.7em;color:#888;cursor:pointer;z-index:2;">
            &times;
        </button>
        <div id="image-gallery-list" style="width:100%;padding:38px 0 28px 0;max-height:75vh;overflow-y:auto;">
            <!-- Bài viết sẽ được render ở đây -->
        </div>
    </div>
</div>
{{-- Modal video Gallery --}}
<div id="video-gallery-modal" style="display:none;position:fixed;z-index:10001;top:0;left:0;width:100vw;height:100vh;background:rgba(0,0,0,0.85);align-items:center;justify-content:center;">
    <div style="background:#fff;border-radius:18px;box-shadow:0 8px 32px rgba(0,0,0,0.19);max-width:700px;max-height:90vh;display:flex;flex-direction:column;align-items:center;position:relative;padding:0;">
        <button id="video-gallery-close" style="position:absolute;top:10px;right:10px;width:38px;height:38px;background:none;border:none;font-size:1.7em;color:#888;cursor:pointer;z-index:2;">
            &times;
        </button>
        <div id="video-gallery-list" style="width:100%;padding:38px 0 28px 0;max-height:75vh;overflow-y:auto;">
            <!-- Video sẽ được render ở đây -->
        </div>
    </div>
</div>
{{-- Modal document Gallery --}}
<div id="document-gallery-modal" style="display:none;position:fixed;z-index:10001;top:0;left:0;width:100vw;height:100vh;background:rgba(0,0,0,0.85);align-items:center;justify-content:center;">
    <div style="background:#fff;border-radius:18px;box-shadow:0 8px 32px rgba(0,0,0,0.19);max-width:700px;max-height:90vh;display:flex;flex-direction:column;align-items:center;position:relative;padding:0;">
        <button id="document-gallery-close" style="position:absolute;top:10px;right:10px;width:38px;height:38px;background:none;border:none;font-size:1.7em;color:#888;cursor:pointer;z-index:2;">
            &times;
        </button>
        <div id="document-gallery-list" style="width:100%;padding:38px 0 28px 0;max-height:75vh;overflow-y:auto;">
            <!-- Tài liệu sẽ được render ở đây -->
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Image gallery
    document.getElementById('show-image-gallery').onclick = function(e) {
        e.preventDefault();
        fetch('{{ route('admin.media.list') }}')
        .then(res => res.json())
        .then(images => {
            const validExt = ['jpg','jpeg','png','gif','svg','webp'];
            const filtered = images.filter(img => {
                const ext = img.file_name.split('.').pop().toLowerCase();
                return validExt.includes(ext);
            });
            const gallery = document.getElementById('image-gallery-list');
            if(filtered.length === 0) {
                gallery.innerHTML = `<div style="color:#888;font-size:1.1em;text-align:center;width:100%;">Không có ảnh nào.</div>`;
            } else {
                gallery.innerHTML = filtered.map(img =>
                    `<div style="background:#f7f8fa;border-radius:14px;box-shadow:0 2px 12px rgba(40,53,147,0.09);margin:0 auto 28px auto;max-width:540px;display:flex;flex-direction:column;align-items:center;padding:24px 18px;">
                        <img src="/media/image/${img.file_name}" alt="${img.file_name}" style="width:100%;max-width:420px;max-height:320px;object-fit:cover;border-radius:12px;box-shadow:0 2px 12px rgba(40,53,147,0.13);margin-bottom:16px;">
                        <div style="font-size:1.08em;color:#222;text-align:left;width:100%;margin-bottom:8px;word-break:break-word;">${img.description ?? ''}</div>
                    </div>`
                ).join('');
            }
            document.getElementById('image-gallery-modal').style.display = 'flex';
        });
    };
    document.getElementById('image-gallery-close').onclick = function() {
        document.getElementById('image-gallery-modal').style.display = 'none';
        document.getElementById('image-gallery-list').innerHTML = '';
    };
    document.getElementById('image-gallery-modal').onclick = function(e) {
        if(e.target === this) {
            this.style.display = 'none';
            document.getElementById('image-gallery-list').innerHTML = '';
        }
    };

    // Video gallery
    document.getElementById('show-video-gallery').onclick = function(e) {
        e.preventDefault();
        fetch('{{ route('admin.media.list_video') }}')
        .then(res => res.json())
        .then(videos => {
            const validExt = ['mp4','avi','mov','mkv','webm','mpeg'];
            const filtered = videos.filter(video => {
                const ext = video.file_name.split('.').pop().toLowerCase();
                return validExt.includes(ext);
            });
            const gallery = document.getElementById('video-gallery-list');
            if(filtered.length === 0) {
                gallery.innerHTML = `<div style="color:#888;font-size:1.1em;text-align:center;width:100%;">Không có video nào.</div>`;
            } else {
                gallery.innerHTML = filtered.map(video =>
                    `<div style="background:#f7f8fa;border-radius:14px;box-shadow:0 2px 12px rgba(40,53,147,0.09);margin:0 auto 28px auto;max-width:540px;display:flex;flex-direction:column;align-items:center;padding:24px 18px;">
                        <video src="/media/video/${video.file_name}" controls style="width:100%;max-width:420px;max-height:320px;border-radius:12px;box-shadow:0 2px 12px rgba(40,53,147,0.13);margin-bottom:16px;"></video>
                        <div style="font-size:1.08em;color:#222;text-align:left;width:100%;margin-bottom:8px;word-break:break-word;">${video.description ?? ''}</div>
                    </div>`
                ).join('');
            }
            document.getElementById('video-gallery-modal').style.display = 'flex';
        });
    };
    document.getElementById('video-gallery-close').onclick = function() {
        document.getElementById('video-gallery-modal').style.display = 'none';
        document.getElementById('video-gallery-list').innerHTML = '';
    };
    document.getElementById('video-gallery-modal').onclick = function(e) {
        if(e.target === this) {
            this.style.display = 'none';
            document.getElementById('video-gallery-list').innerHTML = '';
        }
    };

    // Document gallery
    document.getElementById('show-document-gallery').onclick = function(e) {
        e.preventDefault();
        fetch('{{ route('admin.media.list_document') }}')
        .then(res => res.json())
        .then(documents => {
            const validExt = ['pdf','doc','docx','ppt','pptx','xls','xlsx','txt'];
            const extIcon = {
                pdf: 'bi-file-earmark-pdf',
                doc: 'bi-file-earmark-word',
                docx: 'bi-file-earmark-word',
                ppt: 'bi-file-earmark-ppt',
                pptx: 'bi-file-earmark-ppt',
                xls: 'bi-file-earmark-excel',
                xlsx: 'bi-file-earmark-excel',
                txt: 'bi-file-earmark-text'
            };
            const filtered = documents.filter(doc => {
                const ext = doc.file_name.split('.').pop().toLowerCase();
                return validExt.includes(ext);
            });
            const gallery = document.getElementById('document-gallery-list');
            if(filtered.length === 0) {
                gallery.innerHTML = `<div style="color:#888;font-size:1.1em;text-align:center;width:100%;">Không có tài liệu nào.</div>`;
            } else {
                gallery.innerHTML = filtered.map(doc => {
                    const ext = doc.file_name.split('.').pop().toLowerCase();
                    const icon = extIcon[ext] || 'bi-file-earmark';
                    return `<div style="background:#f7f8fa;border-radius:14px;box-shadow:0 2px 12px rgba(40,53,147,0.09);margin:0 auto 28px auto;max-width:540px;display:flex;flex-direction:column;align-items:center;padding:24px 18px;">
                        <a href="/media/document/${encodeURIComponent(doc.file_name)}" target="_blank"
                            style="display:flex;flex-direction:column;align-items:center;text-decoration:none;">

                        </a>
                        <div style="font-size:1.08em;color:#222;text-align:left;width:100%;margin-bottom:8px;word-break:break-word;">${doc.description ?? ''}</div>
                    </div>`;
                }).join('');
            }
            document.getElementById('document-gallery-modal').style.display = 'flex';
        });
    };
    document.getElementById('document-gallery-close').onclick = function() {
        document.getElementById('document-gallery-modal').style.display = 'none';
        document.getElementById('document-gallery-list').innerHTML = '';
    };
    document.getElementById('document-gallery-modal').onclick = function(e) {
        if(e.target === this) {
            this.style.display = 'none';
            document.getElementById('document-gallery-list').innerHTML = '';
        }
    };
});
</script>
@endsection


