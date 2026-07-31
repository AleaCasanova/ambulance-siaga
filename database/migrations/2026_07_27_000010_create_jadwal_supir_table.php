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
        Schema::create('jadwal_supir', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supir_id')->constrained('supir')->cascadeOnDelete();
            $table->foreignId('ambulans_id')->nullable()->constrained('ambulans')->nullOnDelete();
            $table->string('hari', 30); // Senin, Selasa, ..., Minggu, atau Setiap Hari
            $table->time('jam_mulai')->default('00:00:00');
            $table->time('jam_selesai')->default('23:59:59');
            $table->enum('status', ['Aktif', 'Libur', 'Cuti'])->default('Aktif');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_supir');
    }
};
