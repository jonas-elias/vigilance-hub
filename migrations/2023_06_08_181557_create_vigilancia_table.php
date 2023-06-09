<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateVigilanciaTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vigilancia', function (Blueprint $table) {
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
        Schema::dropIfExists('vigilancia');
    }
}
