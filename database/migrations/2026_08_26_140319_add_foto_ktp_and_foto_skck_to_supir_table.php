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
        Schema::table('supir', function (Blueprint $table) {
            $table->string('nik', 30)->nullable()->after('no_wa');
            $table->string('foto_ktp')->nullable()->after('nik');
            $table->string('nomor_skck', 50)->nullable()->after('nomor_stnk');
            $table->string('foto_skck')->nullable()->after('nomor_skck');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('supir', function (Blueprint $table) {
            $table->dropColumn(['nik', 'foto_ktp', 'nomor_skck', 'foto_skck']);
        });
    }
};
