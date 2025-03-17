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
        Schema::create('periksas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pasien')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_dokter')->constrained('users')->onDelete('cascade');
            $table->dateTime('tgl_periksa')->nullable(false);
            $table->text('catatan')->nullable();
            $table->integer('biaya_periksa')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
{
    if (Schema::hasTable('detail_periksas')) {
        Schema::table('detail_periksas', function (Blueprint $table) {
            $table->dropForeign(['id_periksa']);
            $table->dropForeign(['id_obat']);
        });

        Schema::dropIfExists('detail_periksas');
    }

    Schema::dropIfExists('periksas');
}

};
