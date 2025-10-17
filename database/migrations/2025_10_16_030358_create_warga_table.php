<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // public function up(): void
    // {
    //     Schema::create('warga', function (Blueprint $table) {
    //         $table->id();
    //         $table->timestamps();
    //     });
    // }
    public function up()
    {
    Schema::create('warga', function (Blueprint $table) {
        $table->id('warga_id');
        $table->string('no_ktp', 100)->unique();
        $table->string('nama', 100);
        $table->enum('jenis_kelamin', ['Male', 'Female', 'Other']);
        $table->string('agama', 100);
        $table->string('pekerjaan', 100);
        $table->string('email', 250);
        $table->string('telp', 20);
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warga');
    }
};
