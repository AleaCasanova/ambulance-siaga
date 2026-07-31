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
        Schema::create('laporan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pemesanan_id')->nullable()->constrained('pemesanan')->nullOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('jenis_laporan', 50); // e.g., Kendala Teknis, Keluhan Pelayanan, Darurat Tambahan
            $table->string('judul');
            $table->text('deskripsi');
            $table->enum('status_laporan', ['Baru', 'Diproses', 'Selesai'])->default('Baru');
            $table->text('tindak_lanjut')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan');
    }
};
