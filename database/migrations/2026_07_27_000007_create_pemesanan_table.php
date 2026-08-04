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
        Schema::create('pemesanan', function (Blueprint $table) {
            $table->id();
            $table->string('kode_order', 50)->unique();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('supir_id')->nullable()->constrained('supir')->nullOnDelete();
            $table->foreignId('ambulans_id')->nullable()->constrained('ambulans')->nullOnDelete();
            $table->foreignId('rumah_sakit_id')->nullable()->constrained('rumah_sakit')->nullOnDelete();
            $table->foreignId('dispatcher_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('nama_pasien');
            $table->string('nik_pasien', 30)->nullable();
            $table->string('usia_pasien', 30)->nullable();
            $table->string('diagnosa_medis')->nullable();
            $table->text('kondisi_pasien')->nullable();
            $table->text('lokasi_jemput');
            $table->decimal('jemput_lat', 10, 8);
            $table->decimal('jemput_lng', 11, 8);
            $table->text('tujuan_lokasi')->nullable();
            $table->decimal('tujuan_lat', 10, 8)->nullable();
            $table->decimal('tujuan_lng', 11, 8)->nullable();
            $table->date('tanggal_jemput')->nullable();
            $table->string('jam_jemput', 20)->nullable();
            $table->integer('jumlah_pendamping')->default(1)->nullable();
            $table->string('no_hp_kontak', 30)->nullable();
            $table->string('keperluan_penggunaan', 150)->nullable();
            $table->enum('status', ['menunggu', 'diproses', 'menuju_lokasi', 'membawa_pasien', 'selesai', 'dibatalkan'])->default('menunggu');
            $table->text('catatan_tambahan')->nullable();
            $table->timestamp('waktu_pesan')->useCurrent();
            $table->timestamp('waktu_respon')->nullable();
            $table->timestamp('waktu_jemput')->nullable();
            $table->timestamp('waktu_selesai')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanan');
    }
};
