@extends('layouts.adminLayout')
@section('title', 'Media Management')

@section('content')
<style>
    /* Use Laravel Blade default font (system-ui or Segoe UI/SF Pro/Roboto) */
    body, .media-container, .media-header h5, .media-btn, .media-empty, .media-toast {
        font-family: 'Segoe UI', system-ui, Arial, sans-serif !important;
    }
    .media-container {
        background: #fafbfc;
        border-radius: 10px;
        box-shadow: none;
        padding: 24px 0 0 0;
        margin: 40px auto 0 auto;
        max-width: 900px;
    }
    .media-tabs {
        border-bottom: 1px solid #e5e7eb;
        margin-bottom: 0;
        gap: 0;
        justify-content: flex-start;
        background: #fff;
        padding-left: 32px;
    }
    .media-tabs .nav-link {
        font-weight: 500;
        color: #222;
        border-radius: 0;
        margin-right: 2px;
        padding: 12px 28px 10px 28px;
        background: transparent;
        border: none;
        border-bottom: 2.5px solid transparent;
        transition: background 0.18s, color 0.18s, border-bottom 0.18s;
        font-size: 1.04rem;
    }
    .media-tabs .nav-link.active {
        background: #fff;
        color: #2563eb !important;
        border-bottom: 2.5px solid #2563eb;
        font-weight: 600;
        z-index: 2;
    }
    .media-tabs .nav-link:not(.active):hover {
        background: #f3f6fa;
        color: #2563eb;
    }
    .media-tab-pane {
        background: #fff;
        border-radius: 0 0 10px 10px;
        padding: 24px 32px 24px 32px;
        min-height: 180px;
        box-shadow: none;
        margin-top: 0;
        animation: fadeIn 0.5s;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px);}
        to { opacity: 1; transform: none;}
    }
    .media-header {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 18px;
        border-bottom: none;
        padding-bottom: 0;
        background: #fff;
        width: 100%;
        min-height: 38px;
    }
    .media-header h5 {
        margin: 0;
        font-weight: 500;
        color: #222;
        font-size: 1.04rem;
        letter-spacing: 0.1px;
        display: flex;
        align-items: center;
        gap: 8px;
        flex: 1;
    }
    .media-btn {
        border-radius: 50%;
        width: 36px;
        height: 36px;
        min-width: 36px;
        min-height: 36px;
        max-width: 36px;
        max-height: 36px;
        font-weight: 600;
        padding: 0;
        background: #2563eb;
        border: none;
        color: #fff;
        box-shadow: none;
        transition: background 0.18s;
        font-size: 1.25rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0;
    }
    .media-btn i {
        font-size: 1.18em;
        margin: 0;
    }
    .media-btn:hover {
        background: #1d4fd7;
        color: #fff !important;
    }
    .media-empty {
        color: #b0b4c3;
        font-style: italic;
        padding: 32px 0 24px 0;
        text-align: center;
        font-size: 1.03rem;
        letter-spacing: 0.1px;
    }
    .media-icon {
        font-size: 1.13em;
        vertical-align: middle;
    }
    .media-toast {
        position: fixed;
        bottom: 32px;
        left: 50%;
        transform: translateX(-50%);
        background: #2563eb;
        color: #fff;
        padding: 13px 28px;
        border-radius: 11px;
        font-size: 1.02rem;
        font-weight: 500;
        box-shadow: 0 4px 24px rgba(40,53,147,0.13);
        z-index: 9999;
        cursor: pointer;
        animation: fadeInUp 0.4s;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translate(-50%, 32px);}
        to { opacity: 1; transform: translate(-50%, 0);}
    }
    @media (max-width: 700px) {
        .media-container { padding: 8px 0 0 0; }
        .media-tabs { padding-left: 0; }
        .media-tabs .nav-link { padding: 10px 8px; font-size: 0.97rem;}
        .media-tab-pane { padding: 10px 2vw 10px 2vw; }
        .media-header h5 { font-size: 0.97rem; }
        .media-btn { width: 30px; height: 30px; min-width: 30px; min-height: 30px; font-size: 1.05rem;}
    }
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<div class="container media-container">
    <h2 style="font-weight:600;color:#222;letter-spacing:0.5px;margin-bottom:18px;text-align:left;padding-left:32px;font-size:1.35rem;background:#fff;">
        <i class="bi bi-images" style="margin-right:8px;color:#2563eb;"></i>Media Management
    </h2>
    {{-- <ul class="nav nav-tabs media-tabs" id="mediaTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="images-tab" data-bs-toggle="tab" data-bs-target="#images" type="button" role="tab">
                <i class="bi bi-image media-icon"></i> Images
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="videos-tab" data-bs-toggle="tab" data-bs-target="#videos" type="button" role="tab">
                <i class="bi bi-camera-video media-icon"></i> Videos
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="documents-tab" data-bs-toggle="tab" data-bs-target="#documents" type="button" role="tab">
                <i class="bi bi-file-earmark-text media-icon"></i> Documents & Publications
            </button>
        </li>
    </ul> --}}
    <div class="tab-content mt-0" id="mediaTabContent">
        <div class="tab-pane fade show active media-tab-pane" id="images" role="tabpanel">
            <div class="media-header">
                <h5><i class="bi bi-image media-icon"></i> Images</h5>
                <form id="upload-image-form" enctype="multipart/form-data" style="display:inline;">
                    <input type="file" id="image-input" name="image" accept="image/*" style="display:none;">
                    {{-- <input type="text" id="image-description" name="description" placeholder="Nhập mô tả ảnh" style="margin-right:8px;max-width:180px;"> --}}
                    <button type="button" class="media-btn" title="Add Image" id="add-image-btn"><i class="bi bi-plus"></i></button>
                </form>
            </div>
            <div id="media-images-list">
                <div class="media-empty"><i class="bi bi-emoji-frown"></i> No images yet.</div>
            </div>
        </div>

        {{-- Modal for upload --}}
        <div id="media-upload-modal" style="display:none;position:fixed;z-index:10000;top:0;left:0;width:100vw;height:100vh;background:rgba(0,0,0,0.18);align-items:center;justify-content:center;">
            <div style="background:#fff;padding:32px 24px 24px 24px;border-radius:12px;box-shadow:0 8px 32px rgba(0,0,0,0.13);min-width:320px;max-width:90vw;position:relative;">
                <button id="media-upload-modal-close" style="position:absolute;top:10px;right:12px;background:none;border:none;font-size:1.3em;color:#888;cursor:pointer;"><i class="bi bi-x"></i></button>
                <form id="modal-upload-image-form" enctype="multipart/form-data">
                    <div style="margin-bottom:16px;">
                        <label style="font-weight:500;">Chọn ảnh:</label><br>
                        <input type="file" id="modal-image-input" name="image" accept="image/*" required>
                    </div>
                    <div style="margin-bottom:18px;">
                        <label style="font-weight:500;">Mô tả:</label><br>
                        <input type="text" id="modal-image-description" name="description" placeholder="Nhập mô tả ảnh" style="width:100%;max-width:320px;">
                    </div>
                    <button type="submit" class="media-btn" style="border-radius:8px;width:auto;height:auto;min-width:90px;min-height:36px;font-size:1.07em;padding:0 18px;"><i class="bi bi-upload"></i> Upload</button>
                </form>
            </div>
        </div>
        <script>
        document.addEventListener('DOMContentLoaded', function () {

            // Khi ấn dấu + thì hiện modal upload
            document.getElementById('add-image-btn').addEventListener('click', function(e) {
                e.preventDefault();
                document.getElementById('media-upload-modal').style.display = 'flex';
            });

            // Đóng modal khi ấn nút X hoặc click ra ngoài
            document.getElementById('media-upload-modal-close').onclick = function() {
                document.getElementById('media-upload-modal').style.display = 'none';
                document.getElementById('modal-upload-image-form').reset();
            };
            document.getElementById('media-upload-modal').addEventListener('click', function(e) {
                if(e.target === this) {
                    this.style.display = 'none';
                    document.getElementById('modal-upload-image-form').reset();
                }
            });

            // Submit upload trong modal
            document.getElementById('modal-upload-image-form').addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                fetch('{{ route('admin.media.upload') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    if(data.success) {
                        showMediaToast('Upload thành công!');
                        loadImages();
                    } else {
                        showMediaToast('Upload thất bại!');
                    }
                    document.getElementById('media-upload-modal').style.display = 'none';
                    document.getElementById('modal-upload-image-form').reset();
                })
                .catch(() => {
                    showMediaToast('Có lỗi xảy ra!');
                    document.getElementById('media-upload-modal').style.display = 'none';
                    document.getElementById('modal-upload-image-form').reset();
                });
            });

            function loadImages() {
                fetch('{{ route('admin.media.list') }}')
                .then(res => res.json())
                .then(images => {
                    const list = document.getElementById('media-images-list');
                    if(images.length === 0) {
                        list.innerHTML = `<div class="media-empty"><i class="bi bi-emoji-frown"></i> No images yet.</div>`;
                    } else {
                        list.innerHTML = images.map(img =>
                            `<div style="display:inline-block;text-align:center;margin:6px;">
                                <img src="/storage/${img.file_path}" alt="${img.file_name}" style="max-width:120px;margin-bottom:4px;border-radius:6px;border:1px solid #eee;">
                                <div style="font-size:0.97em;color:#555;max-width:120px;word-break:break-word;">${img.description ?? ''}</div>
                            </div>`
                        ).join('');
                    }
                });
            }
            loadImages();
        });
        </script>
        {{-- Manage videos --}}
        <div class="tab-pane fade media-tab-pane" id="videos" role="tabpanel">
            {{-- Manage videos --}}
            <div class="media-header">
                <h5><i class="bi bi-camera-video media-icon"></i> Videos</h5>
                <button class="media-btn" title="Add Video"><i class="bi bi-plus"></i></button>
            </div>
            <div>
                {{-- Display video list here --}}
                <div class="media-empty"><i class="bi bi-emoji-frown"></i> No videos yet.</div>
            </div>
        </div>
        <div class="tab-pane fade media-tab-pane" id="documents" role="tabpanel">
            {{-- Manage documents & publications --}}
            <div class="media-header">
                <h5><i class="bi bi-file-earmark-text media-icon"></i> Documents & Publications</h5>
                <button class="media-btn" title="Add Document/Publication"><i class="bi bi-plus"></i></button>
            </div>
            <div>
                {{-- Display document & publication list here --}}
                <div class="media-empty"><i class="bi bi-emoji-frown"></i> No documents or publications yet.</div>
            </div>
        </div>
    </div>
</div>
<script>
    // Activate tab on click
    document.addEventListener('DOMContentLoaded', function () {
        const tabButtons = document.querySelectorAll('#mediaTab .nav-link');
        const tabPanes = document.querySelectorAll('.tab-pane');
        tabButtons.forEach(btn => {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                tabButtons.forEach(b => b.classList.remove('active'));
                tabPanes.forEach(p => p.classList.remove('show', 'active'));
                this.classList.add('active');
                const target = document.querySelector(this.getAttribute('data-bs-target'));
                if(target) {
                    target.classList.add('show', 'active');
                }
            });
        });

        // Show toast/notification when clicking Add button (demo)
        document.querySelectorAll('.media-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                showMediaToast('Upload your photo!');
            });
        });

        // Close toast on click
        document.body.addEventListener('click', function(e) {
            if(e.target.classList.contains('media-toast')) {
                e.target.remove();
            }
        });
    });

    // Show toast notification function
    function showMediaToast(message) {
        // Remove old toast if exists
        document.querySelectorAll('.media-toast').forEach(t => t.remove());
        const toast = document.createElement('div');
        toast.className = 'media-toast';
        toast.innerHTML = `<i class="bi bi-info-circle"></i> ${message}`;
        document.body.appendChild(toast);
        setTimeout(() => { toast.remove(); }, 2200);
    }
</script>

@endsection
