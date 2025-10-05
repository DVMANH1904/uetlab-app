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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Tiêu đề công việc
            $table->text('description')->nullable(); // Mô tả chi tiết

            // Người giao việc (admin/mentor)
            $table->foreignId('assigner_id')->constrained('users');

            // Người được giao (sinh viên)
            $table->foreignId('assignee_id')->constrained('users');

            $table->date('due_date')->nullable(); // Hạn chót

            // Trạng thái công việc
            $table->enum('status', ['todo', 'in_progress', 'done'])->default('todo');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
