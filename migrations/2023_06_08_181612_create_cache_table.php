<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateCacheTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cache', function (Blueprint $table) {
            $table->bigIncrements('id_cache');
            $table->bigInteger('id_vigilancia');
            $table->foreign('id_vigilancia')->on('vigilancia')->references('id_vigilancia');
            $table->string('chave');
            $table->string('acao', 6);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cache');
    }
}
