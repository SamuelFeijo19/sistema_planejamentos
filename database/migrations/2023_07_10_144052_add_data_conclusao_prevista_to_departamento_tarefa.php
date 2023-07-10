<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('departamento_tarefa', function (Blueprint $table) {
            $table->date('data_conclusao_prevista')->nullable()->comment('Data Prevista para a Conclusão da Tarefa');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('departamento_tarefa', function (Blueprint $table) {
            $table->dropColumn('data_conclusao_prevista');
        });
    }
};
