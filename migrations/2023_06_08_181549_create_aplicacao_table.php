<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateAplicacaoTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('aplicacao', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome');
            $table->bigInteger('id_cliente');
            $table->foreign('id_cliente')->on('cliente')->references('id');
            $table->string('token', 128)->index('aplicacao_token');
            $table->dateTime('data_criacao');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aplicacao');
    }
}
