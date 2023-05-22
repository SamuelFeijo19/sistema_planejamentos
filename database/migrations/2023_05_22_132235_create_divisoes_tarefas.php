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
        Schema::create('divisao_tarefa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('divisao_id');
            $table->unsignedBigInteger('criador_id');
            $table->string('nomeTarefa');
            $table->string('descricao');
            $table->integer('situacao');
            $table->integer('classificacao');
            $table->timestamps();

            $table->foreign('divisao_id')->references('id')->on('divisoes');
            $table->foreign('criador_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('DivisaoTarefa');
    }
};
