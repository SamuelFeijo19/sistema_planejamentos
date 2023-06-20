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
            //
            $table->integer('situacao')->comment('0 - BackLog, 1 - Doing, 2 - Code Review, 3 - Concluído')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('departamento_tarefa', function (Blueprint $table) {
            //
            $table->integer('situacao')->comment('')->change();
        });
    }
};
