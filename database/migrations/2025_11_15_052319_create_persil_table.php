<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('persil', function (Blueprint $table) {
        $table->id('persil_id');
        $table->string('kode_persil', 100)->unique();
        $table->unsignedBigInteger('pemilik_warga_id');
        $table->foreign('pemilik_warga_id')
          ->references('warga_id')
          ->on('warga')
          ->onDelete('restrict');
        $table->integer('luas_m2');
        $table->string('penggunaan', 100);
        $table->string('alamat_lahan', 250);
        $table->string('rt', 5);
        $table->string('rw', 5);
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('persil');
    }
};
