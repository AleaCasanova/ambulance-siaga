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
            $table->foreignId('mitra_id')->nullable()->after('user_id')->constrained('mitras')->nullOnDelete();
            
            // Drop old columns
            $table->dropColumn([
                'nama_lembaga',
                'nama_penanggung_jawab',
                'alamat_unit'
            ]);
        });

        Schema::table('ambulans', function (Blueprint $table) {
            $table->foreignId('mitra_id')->nullable()->after('id')->constrained('mitras')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ambulans', function (Blueprint $table) {
            $table->dropForeign(['mitra_id']);
            $table->dropColumn('mitra_id');
        });

        Schema::table('supir', function (Blueprint $table) {
            $table->dropForeign(['mitra_id']);
            $table->dropColumn('mitra_id');
            
            $table->string('nama_lembaga')->nullable();
            $table->string('nama_penanggung_jawab')->nullable();
            $table->text('alamat_unit')->nullable();
        });
    }
};
