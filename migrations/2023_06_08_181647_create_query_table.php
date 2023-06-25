<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateQueryTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('query', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_monitoramento');
            $table->foreign('id_monitoramento')->on('monitoramento')->references('id')->onDelete('cascade');
            $table->string('conector', 10);
            $table->float('duracao');
            $table->string('query', 8192);
            $table->string('localizacao');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('query');
    }
}
