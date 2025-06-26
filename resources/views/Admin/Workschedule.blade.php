@extends('layouts.adminLayout')
@section('title', 'Quản lý lịch công tác')
@section('content')
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:24px;">
    <h2 style="margin:0;font-size:1.5rem;font-weight:600;color:#2a7de1">Lịch công tác</h2>
    <a href="#" id="add-new-btn" style="background:#2a7de1;color:#fff;padding:8px 20px;border-radius:5px;text-decoration:none;font-weight:500;">+ Thêm mới</a>
</div>
<div style="overflow-x:auto;">
    <table style="width:100%;border-collapse:collapse;background:#fff;">
        <thead>
            <tr style="background:#569ade;">
                <th style="padding:12px 8px;">STT</th>
                <th style="padding:12px 8px;">Tiêu đề</th>
                <th style="padding:12px 8px;">Thời gian</th>
                <th style="padding:12px 8px;">Địa điểm</th>
                <th style="padding:12px 8px;">Người phụ trách</th>
                <th style="padding:12px 8px;">Nội dung</th>
                <th style="padding:12px 8px;">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <tr id="add-row" style="display:none;">
                <td></td>
                <td><input type="text" class="form-control" id="title-input" style="width:100%;" /></td>
                <td><input type="text" class="form-control" id="time-input" style="width:100%;" /></td>
                <td><input type="text" class="form-control" id="location-input" style="width:100%;" /></td>
                <td><input type="text" class="form-control" id="manager-input" style="width:100%;" /></td>
                <td><input type="text" class="form-control" id="note-input" style="width:100%;" /></td>
                <td>
                    <button id="save-btn" style="color:#fff;background:#2a7de1;border:none;padding:4px 4px;border-radius:3px;">OK</button>
                    <button id="cancel-btn" style="color:#fff;background:#e12a2a;border:none;padding:4px 4px;border-radius:3px;">Hủy</button>
                </td>
            </tr>
            @php

            @endphp
            @if(empty($schedules) || count($schedules) === 0)
            <tr>
                <td colspan="6"></td>
                <td style="padding:16px;text-align:center;">
                    <a href="#" class="edit-link" style="color:#2a7de1;margin-right:8px;">
                        <i class="bi bi-pencil-square"></i>
                    </a>
                    <a href="#" class="delete-link" style="color:#e12a2a;">
                        <i class="bi bi-trash"></i>
                    </a>
                </td>
            </tr>
            @else
                {{-- Lặp qua dữ liệu --}}
                @foreach($schedules as $i => $item)
                <tr>
                    <td style="padding:10px 8px;">{{ $i+1 }}</td>
                    <td style="padding:10px 8px;">{{ $item->title }}</td>
                    <td style="padding:10px 8px;">{{ $item->time }}</td>
                    <td style="padding:10px 8px;">{{ $item->location }}</td>
                    <td style="padding:10px 8px;">{{ $item->manager }}</td>
                    <td style="padding:10px 8px;">{{ $item->note }}</td>
                    <td style="padding:10px 8px;">
                        <a href="#" class="edit-link" style="color:#2a7de1;margin-right:8px;">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <a href="#" class="delete-link" data-id="{{ $item->id }}" style="color:#e12a2a;">
                            <i class="bi bi-trash"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
<style>
    .edit-link i { color: #1976d2 !important; font-size: 1.2rem; vertical-align: middle; }
    .delete-link i { color: #e53935 !important; font-size: 1.2rem; vertical-align: middle; }
    .edit-link:hover i { color: #0d47a1 !important; }
    .delete-link:hover i { color: #b71c1c !important; }
    /* Optional: highlight row on hover */
    table tbody tr:hover { background: #f0f6ff; }
    table th, table td {
        color: #000 !important;
        text-align: center;
    }
    .form-control {
        padding: 8px;
        border-bottom: 1px solid #ccc;
        border-right: 1px solid #ccc;
        border-left: none;
        border-top: none;
        border-radius: 4px;
        width: 100%;
        box-sizing: border-box;
    }
    #save-btn, #cancel-btn {
        width: 50px;
        height: 30px;
    }
</style>
@endsection
@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#add-new-btn').on('click', function(e) {
        e.preventDefault();
        $('#add-row').show();
        $('#add-row input').val('');
    });
    $('#cancel-btn').on('click', function() {
        $('#add-row').hide();
    });
    $('#save-btn').on('click', function() {
        let data = {
            title: $('#title-input').val(),
            time: $('#time-input').val(),
            location: $('#location-input').val(),
            manager: $('#manager-input').val(),
            note: $('#note-input').val(),
            _token: '{{ csrf_token() }}'
        };
        $.post('{{ route("admin.schedule.store") }}', data, function(res) {
            location.reload();
        }).fail(function(xhr){
            alert('Có lỗi xảy ra!');
        });
    });

</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).on('click', '.delete-link', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    if (!id) {
        alert('Không tìm thấy id!');
        return;
    }
    if(confirm('Bạn có chắc muốn xóa?')) {
        $.ajax({
            url: '/items/' + id,
            type: 'DELETE',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if(response.success) {
                    // Xóa dòng chứa nút xóa này khỏi bảng
                    $(e.target).closest('tr').remove();
                    location.reload();
                } else {
                    alert(response.message || 'Xóa thất bại!');
                }
            },
            error: function() {
                alert('Có lỗi xảy ra!');
            }
        });
    }
});
</script>
@endsection
