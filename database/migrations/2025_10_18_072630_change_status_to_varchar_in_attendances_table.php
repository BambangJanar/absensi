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
        Schema::table('attendances', function (Blueprint $table) {
            // Mengubah kolom ENUM menjadi VARCHAR dengan panjang 50
            $table->string('status', 50)->change();
        });
    }

    public function down(): void
    {
        Schema::table('attendances', function (Blueprint $table) {
            // Kalau mau rollback, bisa kembaliin ke VARCHAR lama
            $table->string('status', 20)->change();
        });
    }
};
