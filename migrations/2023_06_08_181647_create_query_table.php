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
            $table->bigInteger('id_vigilancia');
            $table->foreign('id_vigilancia')->on('vigilancia')->references('id_vigilancia');
            $table->string('conector');
            $table->string('query', 8192);
            $table->string('localizacao');
            $table->datetimes();
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
