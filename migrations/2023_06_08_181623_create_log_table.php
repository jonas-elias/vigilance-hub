<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateLogTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('log', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_monitoramento');
            $table->foreign('id_monitoramento')->on('monitoramento')->references('id');
            $table->string('nivel', 10);
            $table->string('mensagem', 4096);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log');
    }
}
