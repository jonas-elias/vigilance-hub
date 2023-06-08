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
            $table->bigIncrements('id_aplicacao');
            $table->string('nome');
            $table->bigInteger('id_cliente');
            $table->foreign('id_cliente')->on('cliente')->references('id_cliente');
            $table->uuid('token');
            $table->index('token');
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
