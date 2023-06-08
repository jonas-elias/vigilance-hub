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
            $table->bigIncrements('id_log');
            $table->bigInteger('id_vigilancia');
            $table->foreign('id_vigilancia')->on('vigilancia')->references('id_vigilancia');
            $table->string('nivel', 10);
            $table->string('mensagem', );
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
