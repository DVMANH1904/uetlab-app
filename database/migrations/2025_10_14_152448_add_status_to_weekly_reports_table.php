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
        Schema::table('weekly_reports', function (Blueprint $table) {
            // Thêm cột status, mặc định là 'pending'
            $table->string('status')->default('pending')->after('file_path');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('weekly_reports', function (Blueprint $table) {
            // Xóa cột status nếu migration được rollback
            $table->dropColumn('status');
        });
    }
};
