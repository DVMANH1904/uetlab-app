<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table('weekly_reports', function (Blueprint $table) {
            // Thêm cột 'title', kiểu string (VARCHAR), có thể null
            $table->string('title')->nullable()->after('report_date');
        });
    }

    public function down(): void
    {
        Schema::table('weekly_reports', function (Blueprint $table) {
            // Logic để xóa cột 'title' nếu bạn muốn rollback migration
            $table->dropColumn('title');
        });
    }
};
