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
        Schema::table('posts', function (Blueprint $table) {
            // Lệnh này sẽ xóa 2 cột media_path và media_type
            $table->dropColumn(['media_path', 'media_type']);
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->string('media_path')->nullable();
            $table->string('media_type')->nullable();
        });
    }
};
