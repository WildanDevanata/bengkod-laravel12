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
        Schema::create('obats', function (Blueprint $table) {
            $table->id();
            $table->string('nama_obat', 50)->nullable(false);
            $table->string('kemasan', 35)->nullable(false);
            $table->integer('harga')->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('detail_periksas'); // Pastikan detail_periksas dihapus sebelum obats
        Schema::dropIfExists('obats');
    }    
};
