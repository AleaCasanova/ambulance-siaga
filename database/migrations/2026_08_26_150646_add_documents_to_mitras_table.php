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
        Schema::table('mitras', function (Blueprint $table) {
            $table->string('nik_pj', 30)->nullable()->after('penanggung_jawab');
            $table->string('foto_ktp_pj')->nullable()->after('nik_pj');
            $table->string('nomor_legalitas', 100)->nullable()->after('alamat');
            $table->string('foto_legalitas')->nullable()->after('nomor_legalitas');
            $table->string('plat_nomor_unit', 30)->nullable()->after('foto_legalitas');
            $table->string('merk_kendaraan', 100)->nullable()->after('plat_nomor_unit');
            $table->string('foto_ambulans')->nullable()->after('merk_kendaraan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mitras', function (Blueprint $table) {
            $table->dropColumn([
                'nik_pj',
                'foto_ktp_pj',
                'nomor_legalitas',
                'foto_legalitas',
                'plat_nomor_unit',
                'merk_kendaraan',
                'foto_ambulans',
            ]);
        });
    }
};
