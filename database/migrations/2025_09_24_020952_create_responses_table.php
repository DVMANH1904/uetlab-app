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
        Schema::create('responses', function (Blueprint $table) {
            $table->id();

            // Khóa ngoại, liên kết đến báo cáo trong bảng `weekly_reports`
            // onDelete('cascade') nghĩa là nếu báo cáo bị xóa, các phản hồi liên quan cũng sẽ bị xóa.
            $table->foreignId('weekly_report_id')->constrained()->onDelete('cascade');

            // Khóa ngoại, liên kết đến người dùng trong bảng `users` (để biết ai đã phản hồi)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Cột để lưu nội dung văn bản của phản hồi
            $table->text('content');

            // Tự động tạo 2 cột là `created_at` và `updated_at`
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('responses');
    }
};