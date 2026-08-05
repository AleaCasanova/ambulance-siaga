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
        Schema::table('pemesanan', function (Blueprint $table) {
            $table->string('photo_path')->nullable()->after('lokasi_jemput');
            $table->decimal('photo_latitude', 10, 8)->nullable()->after('photo_path');
            $table->decimal('photo_longitude', 11, 8)->nullable()->after('photo_latitude');
            $table->text('photo_address')->nullable()->after('photo_longitude');
            $table->string('photo_district')->nullable()->after('photo_address');
            $table->string('photo_city')->nullable()->after('photo_district');
            $table->string('photo_province')->nullable()->after('photo_city');
            $table->string('photo_country')->nullable()->after('photo_province');
            $table->dateTime('photo_taken_at')->nullable()->after('photo_country');
            $table->decimal('photo_accuracy', 8, 2)->nullable()->after('photo_taken_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pemesanan', function (Blueprint $table) {
            $table->dropColumn([
                'photo_path',
                'photo_latitude',
                'photo_longitude',
                'photo_address',
                'photo_district',
                'photo_city',
                'photo_province',
                'photo_country',
                'photo_taken_at',
                'photo_accuracy',
            ]);
        });
    }
};
