<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('lab_schedules', function (Blueprint $table) {
            // Xóa các cột cũ
            $table->dropColumn(['start_time', 'end_time']);

            // Thêm các cột mới để lưu quy tắc lặp lại
            $table->tinyInteger('day_of_week'); // 0=Chủ Nhật, 1=Thứ Hai, ..., 6=Thứ Bảy
            $table->time('start_time');       // Ví dụ: '09:00:00'
            $table->time('end_time');         // Ví dụ: '11:00:00'
            $table->date('start_date');       // Ngày quy tắc bắt đầu có hiệu lực
            $table->date('end_date');         // Ngày quy tắc kết thúc
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lab_schedules', function (Blueprint $table) {
            // Thêm lại các cột cũ nếu cần rollback
            $table->dateTime('start_time');
            $table->dateTime('end_time');

            // Xóa các cột mới
            $table->dropColumn(['day_of_week', 'start_time', 'end_time', 'start_date', 'end_date']);
        });
    }
};