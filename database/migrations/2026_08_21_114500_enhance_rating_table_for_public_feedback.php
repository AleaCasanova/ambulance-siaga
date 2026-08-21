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
        Schema::table('rating', function (Blueprint $table) {
            $table->foreignId('pemesanan_id')->nullable()->change();
            $table->foreignId('user_id')->nullable()->change();
            $table->foreignId('supir_id')->nullable()->change();
            $table->string('nama_pengirim')->nullable()->after('supir_id');
            $table->string('peran_pengirim')->nullable()->after('nama_pengirim'); // Donatur, Keluarga Pasien, Relawan, dsb
            $table->string('asal_kota')->nullable()->after('peran_pengirim');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rating', function (Blueprint $table) {
            $table->dropColumn(['nama_pengirim', 'peran_pengirim', 'asal_kota']);
        });
    }
};
