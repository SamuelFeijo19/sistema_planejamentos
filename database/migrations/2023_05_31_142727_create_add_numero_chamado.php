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
        Schema::table('departamento_tarefa', function (Blueprint $table) {
            $table->string('numeroChamado')->nullable();
        });

        Schema::table('divisao_tarefa', function (Blueprint $table) {
            $table->string('numeroChamado')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('departamento_tarefa', function (Blueprint $table) {
            $table->dropColumn('numeroChamado');
        });

        Schema::table('divisao_tarefa', function (Blueprint $table) {
            $table->dropColumn('numeroChamado');
        });    }
};
