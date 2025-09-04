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
        Schema::create('lab_students', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Họ và Tên
            $table->string('student_id')->unique(); // Mã số sinh viên (duy nhất)
            $table->string('email')->unique(); // Email (duy nhất)
            $table->string('major')->nullable(); // Ngành học
            $table->date('join_date'); // Ngày vào lab
            $table->string('status')->default('active'); // Trạng thái: active, graduated, inactive
            $table->text('project_topic')->nullable(); // Đề tài/Dự án đang làm
            $table->text('notes')->nullable(); // Ghi chú thêm
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lab_students');
    }
};
