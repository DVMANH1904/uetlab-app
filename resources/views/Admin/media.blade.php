<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Media') }}
        </h2>
    </x-slot>
     <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
                    /* max-width: 900px; */
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
                #modal-image-input {
                    width: 88px;
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

                /* --- Tách CSS inline xuống đây --- */
                .media-title {
                    font-weight:600;
                    color:#222;
                    letter-spacing:0.5px;
                    margin-bottom:18px;
                    text-align:left;
                    padding-left:32px;
                    font-size:1.35rem;
                    background:#fff;
                }
                .media-title-icon {
                    margin-right:8px;
                    color:#2563eb;
                }
                .media-upload-modal {
                    display:none;
                    position:fixed;
                    z-index:10000;
                    top:0;
                    left:0;
                    width:100vw;
                    height:100vh;
                    background:rgba(0,0,0,0.18);
                    align-items:center;
                    justify-content:center;
                }
                .media-upload-modal-content {
                    background:#fff;
                    padding:32px 24px 24px 24px;
                    border-radius:12px;
                    box-shadow:0 8px 32px rgba(0,0,0,0.13);
                    min-width:320px;
                    max-width:90vw;
                    position:relative;
                }
                .media-upload-modal-close {
                    position:absolute;
                    top:10px;
                    right:10px;
                    width: 36px;
                    background:none;
                    border:none;
                    font-size:1.3em;
                    color:#888;
                    cursor:pointer;
                }
                .media-upload-modal-field {
                    margin-bottom:16px;
                }
                .media-upload-modal-label {
                    font-weight:500;
                }
                .media-upload-modal-input {
                    width:100%;
                    max-width:320px;
                }
                .media-upload-modal-submit {
                    border-radius:8px;
                    width:auto;
                    height:auto;
                    min-width:90px;
                    min-height:36px;
                    font-size:0.9em;
                    padding:0 18px;
                }
            </style>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
            <div class="container media-container">
                <h2 class="media-title">
                    <i class="bi bi-images media-title-icon"></i>Media Management
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
                    <div id="media-upload-modal" class="media-upload-modal">
                        <div class="media-upload-modal-content">
                            <button id="media-upload-modal-close" class="media-upload-modal-close"><i class="bi bi-x"></i></button>
                            <form id="modal-upload-image-form" enctype="multipart/form-data">
                                <div class="media-upload-modal-field">
                                    <label class="media-upload-modal-label">Chọn ảnh:</label><br>
                                    <input type="file" id="modal-image-input" name="image" accept="image/*" required>
                                    <span id="modal-image-filename" style="margin-left:10px;color:#222;font-size:0.98em;"></span>
                                </div>
                                <div class="media-upload-modal-field">
                                    <label class="media-upload-modal-label">Mô tả:</label><br>
                                    <input type="text" id="modal-image-description" name="description" placeholder="Nhập mô tả ảnh" class="media-upload-modal-input">
                                </div>
                                <button type="submit" class="media-btn media-upload-modal-submit"><i class="bi bi-upload" style="padding-right: 5px"></i>Upload</button>
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
                            resetModalFileName();
                        };
                        document.getElementById('media-upload-modal').addEventListener('click', function(e) {
                            if(e.target === this) {
                                this.style.display = 'none';
                                document.getElementById('modal-upload-image-form').reset();
                                resetModalFileName();
                            }
                        });

                        // Hiển thị tên file khi chọn file
                        document.getElementById('modal-image-input').addEventListener('change', function() {
                            const fileName = this.files && this.files.length > 0 ? this.files[0].name : '';
                            document.getElementById('modal-image-filename').textContent = fileName;
                        });

                        function resetModalFileName() {
                            document.getElementById('modal-image-filename').textContent = '';
                        }

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
                                resetModalFileName(); // Xóa tên file sau khi upload
                            })
                            .catch(() => {
                                showMediaToast('Có lỗi xảy ra!');
                                document.getElementById('media-upload-modal').style.display = 'none';
                                document.getElementById('modal-upload-image-form').reset();
                                resetModalFileName(); // Xóa tên file sau khi upload
                            });
                        });

                        function loadImages() {
                            fetch('{{ route('admin.media.list') }}')
                            .then(res => res.json())
                            .then(images => {
                                const list = document.getElementById('media-images-list');
                                // Chỉ lấy các file có đuôi ảnh hợp lệ
                                const validExt = ['jpg','jpeg','png','gif','svg','webp'];
                                const filtered = images.filter(img => {
                                    const ext = img.file_name.split('.').pop().toLowerCase();
                                    return validExt.includes(ext);
                                });
                                if(filtered.length === 0) {
                                    list.innerHTML = `<div class="media-empty"><i class="bi bi-emoji-frown"></i> No images yet.</div>`;
                                } else {
                                    list.innerHTML = filtered.map((img, idx) =>
                                        `<div style="display:inline-block;text-align:center;margin:6px;">
                                            <img src="/media/image/${img.file_name}" alt="${img.file_name}"
                                                style="max-width:120px;margin-bottom:4px;border-radius:6px;border:1px solid #eee;cursor:pointer;"
                                                class="media-detail-img" data-index="${idx}">
                                            <div style="font-size:0.97em;color:#555;max-width:120px;word-break:break-word;">${img.description ?? ''}</div>
                                        </div>`
                                    ).join('');
                                    // Thêm sự kiện click cho ảnh
                                    setTimeout(() => {
                                        document.querySelectorAll('.media-detail-img').forEach(imgEl => {
                                            imgEl.onclick = function() {
                                                const index = parseInt(this.getAttribute('data-index'));
                                                showImageDetail(filtered, index);
                                            };
                                        });
                                    }, 50);
                                }
                            });
                        }
                        loadImages();
                    });
                    </script>
                    {{-- videos manager  --}}
                    <div class="tab-pane fade show active media-tab-pane" id="videos" role="tabpanel">
                        <div class="media-header">
                            <h5><i class="bi bi-camera-video media-icon"></i> Videos</h5>
                            <form id="upload-video-form" enctype="multipart/form-data" style="display:inline;">
                                <input type="file" id="video-input" name="video" accept="video/*" style="display:none;">
                                <button type="button" class="media-btn" title="Add Videos" id="add-video-btn"><i class="bi bi-plus"></i></button>
                            </form>
                        </div>
                        <div id="media-videos-list">
                            <div class="media-empty"><i class="bi bi-emoji-frown"></i> No videos yet.</div>
                        </div>
                    </div>

                    <div id="video-upload-modal" class="media-upload-modal">
                        <div class="media-upload-modal-content">
                            <button id="video-upload-modal-close" class="media-upload-modal-close"><i class="bi bi-x"></i></button>
                            <form id="modal-upload-video-form" enctype="multipart/form-data">
                                <div class="media-upload-modal-field">
                                    <label class="media-upload-modal-label">Chọn video:</label><br>
                                    <input type="file" id="modal-video-input" name="video" accept="video/*" required>
                                    <span id="modal-video-filename" style="margin-left:10px;color:#222;font-size:0.98em;"></span>
                                </div>
                                <div class="media-upload-modal-field">
                                    <label class="media-upload-modal-label">Mô tả:</label><br>
                                    <input type="text" id="modal-video-description" name="description" placeholder="Nhập mô tả video" class="media-upload-modal-input">
                                </div>
                                <button type="submit" class="media-btn media-upload-modal-submit"><i class="bi bi-upload" style="padding-right: 5px"></i>Upload</button>
                            </form>
                        </div>
                    </div>
                    <script>
                    document.addEventListener('DOMContentLoaded', function () {

                        // Khi ấn dấu + thì hiện modal upload video
                        document.getElementById('add-video-btn').addEventListener('click', function(e) {
                            e.preventDefault();
                            document.getElementById('video-upload-modal').style.display = 'flex';
                        });

                        // Đóng modal khi ấn nút X hoặc click ra ngoài
                        document.getElementById('video-upload-modal-close').onclick = function() {
                            document.getElementById('video-upload-modal').style.display = 'none';
                            document.getElementById('modal-upload-video-form').reset();
                            resetVideoModalFileName();
                        };
                        document.getElementById('video-upload-modal').addEventListener('click', function(e) {
                            if(e.target === this) {
                                this.style.display = 'none';
                                document.getElementById('modal-upload-video-form').reset();
                                resetVideoModalFileName();
                            }
                        });

                        // Hiển thị tên file khi chọn video
                        document.getElementById('modal-video-input').addEventListener('change', function() {
                            const fileName = this.files && this.files.length > 0 ? this.files[0].name : '';
                            document.getElementById('modal-video-filename').textContent = fileName;
                        });

                        function resetVideoModalFileName() {
                            document.getElementById('modal-video-filename').textContent = '';
                        }

                        // Submit upload video trong modal
                        document.getElementById('modal-upload-video-form').addEventListener('submit', function(e) {
                            e.preventDefault();
                            const formData = new FormData(this);
                            fetch('{{ route('admin.media.upload_video') }}', {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: formData
                            })
                            .then(res => res.json())
                            .then(data => {
                                if(data.success) {
                                    showMediaToast('Upload video thành công!');
                                    loadVideos();
                                } else {
                                    showMediaToast('Upload video thất bại!');
                                }
                                document.getElementById('video-upload-modal').style.display = 'none';
                                document.getElementById('modal-upload-video-form').reset();
                                resetVideoModalFileName();
                            })
                            .catch(() => {
                                showMediaToast('Có lỗi xảy ra!');
                                document.getElementById('video-upload-modal').style.display = 'none';
                                document.getElementById('modal-upload-video-form').reset();
                                resetVideoModalFileName();
                            });
                        });

                        function loadVideos() {
                            fetch('{{ route('admin.media.list_video') }}')
                            .then(res => res.json())
                            .then(videos => {
                                const list = document.getElementById('media-videos-list');
                                // Chỉ lấy các file có đuôi video hợp lệ
                                const validExt = ['mp4','avi','mov','mkv','webm','mpeg'];
                                const filtered = videos.filter(video => {
                                    const ext = video.file_name.split('.').pop().toLowerCase();
                                    return validExt.includes(ext);
                                });
                                if(filtered.length === 0) {
                                    list.innerHTML = `<div class="media-empty"><i class="bi bi-emoji-frown"></i> No videos yet.</div>`;
                                } else {
                                    list.innerHTML = filtered.map(video =>
                                        `<div style="display:inline-block;text-align:center;margin:6px;">
                                            <video src="/media/video/${video.file_name}" controls style="max-width:180px;margin-bottom:4px;border-radius:6px;border:1px solid #eee;"></video>
                                            <div style="font-size:0.97em;color:#555;max-width:180px;word-break:break-word;">${video.description ?? ''}</div>
                                        </div>`
                                    ).join('');
                                }
                            });
                        }
                        loadVideos();
                    });
                    </script>

                    {{-- Manage documents & publications --}}
                    <div class="tab-pane fade media-tab-pane" id="documents" role="tabpanel">
                        <div class="media-header">
                            <h5><i class="bi bi-file-earmark-text media-icon"></i> Documents & Publications</h5>
                            <form id="upload-document-form" enctype="multipart/form-data" style="display:inline;">
                                <input type="file" id="document-input" name="document" accept=".pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx,.txt" style="display:none;">
                                <button type="button" class="media-btn" title="Add Document/Publication" id="add-document-btn"><i class="bi bi-plus"></i></button>
                            </form>
                        </div>
                        <div id="media-documents-list">
                            <div class="media-empty"><i class="bi bi-emoji-frown"></i> No documents or publications yet.</div>
                        </div>
                    </div>

                    <div id="document-upload-modal" class="media-upload-modal">
                        <div class="media-upload-modal-content">
                            <button id="document-upload-modal-close" class="media-upload-modal-close"><i class="bi bi-x"></i></button>
                            <form id="modal-upload-document-form" enctype="multipart/form-data">
                                <div class="media-upload-modal-field">
                                    <label class="media-upload-modal-label">Chọn tài liệu:</label><br>
                                    <input type="file" id="modal-document-input" name="document" accept=".pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx,.txt" required>
                                    <span id="modal-document-filename" style="margin-left:10px;color:#222;font-size:0.98em;"></span>
                                </div>
                                <div class="media-upload-modal-field">
                                    <label class="media-upload-modal-label">Mô tả:</label><br>
                                    <input type="text" id="modal-document-description" name="description" placeholder="Nhập mô tả tài liệu" class="media-upload-modal-input">
                                </div>
                                <button type="submit" class="media-btn media-upload-modal-submit"><i class="bi bi-upload" style="padding-right: 5px"></i>Upload</button>
                            </form>
                        </div>
                    </div>
                    <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        // Khi ấn dấu + thì hiện modal upload document
                        document.getElementById('add-document-btn').addEventListener('click', function(e) {
                            e.preventDefault();
                            document.getElementById('document-upload-modal').style.display = 'flex';
                        });

                        // Đóng modal khi ấn nút X hoặc click ra ngoài
                        document.getElementById('document-upload-modal-close').onclick = function() {
                            document.getElementById('document-upload-modal').style.display = 'none';
                            document.getElementById('modal-upload-document-form').reset();
                            resetDocumentModalFileName();
                        };
                        document.getElementById('document-upload-modal').addEventListener('click', function(e) {
                            if(e.target === this) {
                                this.style.display = 'none';
                                document.getElementById('modal-upload-document-form').reset();
                                resetDocumentModalFileName();
                            }
                        });

                        // Hiển thị tên file khi chọn document
                        document.getElementById('modal-document-input').addEventListener('change', function() {
                            const fileName = this.files && this.files.length > 0 ? this.files[0].name : '';
                            document.getElementById('modal-document-filename').textContent = fileName;
                        });

                        function resetDocumentModalFileName() {
                            document.getElementById('modal-document-filename').textContent = '';
                        }

                        // Submit upload document trong modal
                        document.getElementById('modal-upload-document-form').addEventListener('submit', function(e) {
                            e.preventDefault();
                            const formData = new FormData(this);
                            fetch('{{ route('admin.media.upload_document') }}', {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: formData
                            })
                            .then(res => res.json())
                            .then(data => {
                                if(data.success) {
                                    showMediaToast('Upload tài liệu thành công!');
                                    loadDocuments();
                                } else {
                                    showMediaToast('Upload tài liệu thất bại!');
                                }
                                document.getElementById('document-upload-modal').style.display = 'none';
                                document.getElementById('modal-upload-document-form').reset();
                                resetDocumentModalFileName();
                            })
                            .catch(() => {
                                showMediaToast('Có lỗi xảy ra!');
                                document.getElementById('document-upload-modal').style.display = 'none';
                                document.getElementById('modal-upload-document-form').reset();
                                resetDocumentModalFileName();
                            });
                        });

                        function loadDocuments() {
                            fetch('{{ route('admin.media.list_document') }}')
                            .then(res => res.json())
                            .then(documents => {
                                const list = document.getElementById('media-documents-list');
                                // Chỉ lấy các file có đuôi tài liệu hợp lệ
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
                                if(filtered.length === 0) {
                                    list.innerHTML = `<div class="media-empty"><i class="bi bi-emoji-frown"></i> No documents or publications yet.</div>`;
                                } else {
                                    list.innerHTML = filtered.map(doc => {
                                        const ext = doc.file_name.split('.').pop().toLowerCase();
                                        const icon = extIcon[ext] || 'bi-file-earmark';
                                        return `<div style="display:inline-block;vertical-align:top;margin:10px 12px 18px 12px;max-width:170px;">
                                            <a href="/media/document/${doc.file_name}" target="_blank"
                                            style="display:flex;flex-direction:column;align-items:center;text-decoration:none;background:#f6f8fa;border-radius:14px;padding:18px 10px 12px 10px;box-shadow:0 2px 12px rgba(40,53,147,0.07);transition:box-shadow 0.18s;"
                                            onmouseover="this.style.boxShadow='0 4px 18px rgba(40,53,147,0.13)';"
                                            onmouseout="this.style.boxShadow='0 2px 12px rgba(40,53,147,0.07)';">
                                                <div style="font-size:0.97em;color:#555;text-align:center;word-break:break-word;margin-bottom:7px;max-width:140px;">${doc.description ?? ''}</div>
                                                <i class="bi ${icon}" style="font-size:3.2em;color:#2563eb;margin-bottom:10px;"></i>
                                                <span style="font-size:1.01em;color:#222;font-weight:500;text-align:center;word-break:break-word;max-width:140px;">${doc.file_name}</span>
                                            </a>
                                        </div>`;
                                    }).join('');
                                }
                            });
                        }
                        loadDocuments();
                    });
                    </script>
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
                    document.querySelectorAll('.media-toast').forEach(t => t.remove());
                    const toast = document.createElement('div');
                    toast.className = 'media-toast';
                    toast.innerHTML = `<i class="bi bi-info-circle"></i> ${message}`;
                    document.body.appendChild(toast);
                    setTimeout(() => { toast.remove(); }, 2200);
                }

                // Thêm modal chi tiết ảnh kiểu Instagram
                function showImageDetail(images, index) {
                    const modal = document.getElementById('media-image-detail-modal');
                    const imgTag = document.getElementById('media-image-detail-img');
                    const descTag = document.getElementById('media-image-detail-desc');
                    const prevBtn = document.getElementById('media-image-detail-prev');
                    const nextBtn = document.getElementById('media-image-detail-next');
                    let currentIndex = index;

                    function updateModal(idx) {
                        const img = images[idx];
                        imgTag.src = `/media/image/${img.file_name}`;
                        imgTag.alt = img.file_name;
                        descTag.textContent = img.description ?? '';
                        prevBtn.style.display = idx > 0 ? 'inline-block' : 'none';
                        nextBtn.style.display = idx < images.length - 1 ? 'inline-block' : 'none';
                    }

                    updateModal(currentIndex);
                    modal.style.display = 'flex';

                    prevBtn.onclick = function() {
                        if(currentIndex > 0) {
                            currentIndex--;
                            updateModal(currentIndex);
                        }
                    };
                    nextBtn.onclick = function() {
                        if(currentIndex < images.length - 1) {
                            currentIndex++;
                            updateModal(currentIndex);
                        }
                    };
                    document.getElementById('media-image-detail-close').onclick = function() {
                        modal.style.display = 'none';
                        imgTag.src = '';
                        descTag.textContent = '';
                    };
                    modal.onclick = function(e) {
                        if(e.target === modal) {
                            modal.style.display = 'none';
                            imgTag.src = '';
                            descTag.textContent = '';
                        }
                    };
                }
            </script>

            <div id="media-image-detail-modal" style="display:none;position:fixed;z-index:10001;top:0;left:0;width:100vw;height:100vh;background:rgba(0,0,0,0.82);align-items:center;justify-content:center;">
                <div id="media-image-detail-content" style="background:#fff;border-radius:16px;box-shadow:0 8px 32px rgba(0,0,0,0.19);max-width:96vw;max-height:90vh;display:flex;flex-direction:column;align-items:center;position:relative;padding:0;">
                    <button id="media-image-detail-close" style="position:absolute;top:10px;right:10px;width:36px;height:36px;background:none;border:none;font-size:1.7em;color:#888;cursor:pointer;z-index:2;">
                        <i class="bi bi-x"></i>
                    </button>
                    <img id="media-image-detail-img" src="" alt="" style="max-width:80vw;max-height:70vh;border-radius:14px;box-shadow:0 2px 12px rgba(40,53,147,0.13);margin-top:32px;">
                    <div id="media-image-detail-desc" style="margin:18px 0 24px 0;font-size:1.08em;color:#222;font-weight:500;text-align:center;max-width:700px;word-break:break-word;"></div>
                    <div id="media-image-detail-nav" style="display:flex;gap:18px;margin-bottom:18px;">
                        <button id="media-image-detail-prev" style="background:#2563eb;color:#fff;border:none;border-radius:50%;width:38px;height:38px;font-size:1.3em;display:none;"><i class="bi bi-chevron-left"></i></button>
                        <button id="media-image-detail-next" style="background:#2563eb;color:#fff;border:none;border-radius:50%;width:38px;height:38px;font-size:1.3em;display:none;"><i class="bi bi-chevron-right"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
