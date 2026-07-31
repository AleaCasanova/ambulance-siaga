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
        Schema::create('ambulans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_ambulans', 50)->unique(); // e.g. AMB-01
            $table->string('plat_nomor', 30)->unique(); // e.g. R 1234 SC
            $table->string('jenis_ambulans', 50)->default('Darurat / Medis'); // Emergency, Jenazah, Transport
            $table->enum('status', ['Tersedia', 'Ditugaskan', 'Perawatan', 'Tidak Aktif'])->default('Tersedia');
            $table->string('kapasitas_medis')->nullable();
            $table->text('perlengkapan_medis')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ambulans');
    }
};
