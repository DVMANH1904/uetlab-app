@extends('layouts.app')
@section('title', 'Lịch công tác')
@section('content')
<div style="overflow-x:auto;" class="calendar-box">
    <div class="path">
        <a href="">TRANG CHỦ</a>
        <div>></div>
        <a href="">LỊCH CÔNG TÁC</a>
    </div>
    <div class="title">
        PHÒNG THÍ NGHIỆM TƯƠNG TÁC NGƯỜI MÁY - LỊCH CÔNG TÁC
    </div>
    <table class="table_calendar" style="border-collapse:collapse;background:#fff;">
        <thead>
            <tr style="background:#314fa7; color: #fff;">
                <th style="padding:12px 8px;">STT</th>
                <th style="padding:12px 8px;">Tiêu đề</th>
                <th style="padding:12px 8px;">Thời gian</th>
                <th style="padding:12px 8px;">Địa điểm</th>
                <th style="padding:12px 8px;">Người phụ trách</th>
                <th style="padding:12px 8px;">Nội dung</th>
            </tr>
        </thead>
        <tbody>
                {{-- Lặp qua dữ liệu --}}
                @foreach($schedules as $i => $item)
                <tr>
                    <td style="padding:10px 8px;">{{ $i+1 }}</td>
                    <td style="padding:10px 8px;">{{ $item->title }}</td>
                    <td style="padding:10px 8px;">{{ $item->time }}</td>
                    <td style="padding:10px 8px;">{{ $item->location }}</td>
                    <td style="padding:10px 8px;">{{ $item->manager }}</td>
                    <td style="padding:10px 8px;">{{ $item->note }}</td>
                </tr>
                @endforeach
        </tbody>
    </table>
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4262.075264325052!2d105.7801040757113!3d21.038243387451953!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab354920c233%3A0x5d0313a3bfdc4f37!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBDw7RuZyBuZ2jhu4csIMSQ4bqhaSBo4buNYyBRdeG7kWMgZ2lhIEjDoCBO4buZaQ!5e1!3m2!1svi!2s!4v1749107757745!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>

<style>
    @media (min-width: 992px) {
        .calendar-box .table_calendar {
            position: absolute;
            left: 15%;
            width: 70%;
        }
        .calendar-box {
            position: absolute;
            top: 150px;
        }
    }

    @media (min-width: 769px) and (max-width: 991px) {
        .calendar-box .table_calendar {
            position: absolute;
            left: 5%;
            width: 90%;
        }
        .calendar-box {
            position: absolute;
            top: 150px;
        }
    }

    @media (max-width: 768px) {
        .calendar-box .table_calendar {
            position: absolute;
            left: 0.5%;
            width: 99%;
        }
        .calendar-box {
            position: absolute;
            top: 100px;
        }
    }
    .path , .title {
        width: 100%;
        height: 50px;
        display: flex;
        justify-content: center;
        align-items: center;
        text-decoration: none;
        font-weight: bold;
    }
    .path div, .title {
        margin: 0 10px;
        color: #253b80;
    }
    .path a {
        text-decoration: none;
        padding: 0 10px;
        color: #253b80;
    }
    .calendar-box {
        width: 100%;
        text-align: center;
        background-color: #f0f0f0;
        height: calc(100vh);
    }
    .calendar-box iframe {
        position: absolute;
        bottom: 0;
        left: 0;
    }
    /* Optional: highlight row on hover */
    table tbody tr:hover { background: #f0f6ff; }
    table td {
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
