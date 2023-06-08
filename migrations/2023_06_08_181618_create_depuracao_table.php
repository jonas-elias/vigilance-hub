<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateDepuracaoTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('depuracao', function (Blueprint $table) {
            $table->bigIncrements('id_depuracao');
            $table->bigInteger('id_vigilancia');
            $table->foreign('id_vigilancia')->on('vigilancia')->references('id_vigilancia');
            $table->string('depuracao', 4096);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('depuracao');
    }
}
