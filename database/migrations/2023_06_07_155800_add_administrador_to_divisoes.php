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
        Schema::table('divisoes', function (Blueprint $table) {
            $table->unsignedBigInteger('administrador_id')->nullable();

            $table->foreign('administrador_id')
                ->references('id')
                ->on('servidores')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('divisoes', function (Blueprint $table) {
            $table->dropForeign(['administrador_id']);
            $table->dropColumn('administrador_id');
        });
    }
};
