<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateRequestTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('request', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_monitoramento');
            $table->foreign('id_monitoramento')->on('monitoramento')->references('id')->onDelete('cascade');
            $table->string('metodo', 7);
            $table->string('uri');
            $table->integer('status');
            $table->float('duracao');
            $table->string('headers', 8192);
            $table->string('response', 8192);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request');
    }
}
