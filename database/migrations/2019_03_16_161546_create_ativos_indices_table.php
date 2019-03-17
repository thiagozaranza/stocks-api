<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAtivosIndicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ativos_indices', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('ativo_id');
            $table->unsignedInteger('indice_id');
            $table->timestamps();

            $table->foreign('ativo_id')->references('id')->on('ativos');
            $table->foreign('indice_id')->references('id')->on('indices');
            $table->unique(['ativo_id', 'indice_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ativos_indices');
    }
}
