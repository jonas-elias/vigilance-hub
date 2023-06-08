<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateErroTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('erro', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_vigilancia');
            $table->foreign('id_vigilancia')->on('vigilancia')->references('id_vigilancia');
            $table->string('stacktrace', 8192);
            $table->string('query', 8192);
            $table->string('nivel', 10);
            $table->string('localizacao');
            $table->datetimes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('erro');
    }
}
