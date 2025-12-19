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
        Schema::create('sengketa_persil', function (Blueprint $table) {
            $table->id('sengketa_id');
            $table->unsignedBigInteger('persil_id');
            $table->foreign('persil_id')
                ->references('persil_id')
                ->on('persil')
                ->onDelete('restrict');
            $table->string('pihak_1');
            $table->string('pihak_2');
            $table->text('kronologi');
            $table->string('status');
            $table->text('penyelesaian')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sengketa_persil');
    }
};
