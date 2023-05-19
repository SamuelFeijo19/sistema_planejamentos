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
        Schema::create('divisao_servidor', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('servidor_id');
            $table->unsignedBigInteger('divisao_id');
            $table->timestamps();

            $table->foreign('servidor_id')->references('id')->on('servidores');
            $table->foreign('divisao_id')->references('id')->on('divisoes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('divisao_servidor');
    }
};
