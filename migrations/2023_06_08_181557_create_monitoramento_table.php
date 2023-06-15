<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateMonitoramentoTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('monitoramento', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_aplicacao');
            $table->foreign('id_aplicacao')->on('aplicacao')->references('id');
            $table->dateTime('data_criacao');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monitoramento');
    }
}
