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
        Schema::create('supir', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('nama_lembaga')->nullable();
            $table->string('nama_penanggung_jawab')->nullable();
            $table->string('no_wa', 30)->nullable();
            $table->text('alamat_unit')->nullable();
            $table->string('merk_kendaraan', 100)->nullable();
            $table->string('plat_nomor', 30)->nullable();
            $table->string('nomor_sim', 50)->nullable();
            $table->string('nomor_stnk', 50)->nullable();
            $table->boolean('status_online')->default(false);
            $table->decimal('lokasi_terakhir_lat', 10, 8)->nullable();
            $table->decimal('lokasi_terakhir_lng', 11, 8)->nullable();
            $table->decimal('rating_rata_rata', 3, 2)->default(5.00);
            $table->unsignedInteger('total_perjalanan')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supir');
    }
};
