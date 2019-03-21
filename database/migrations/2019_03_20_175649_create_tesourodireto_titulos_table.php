<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTesourodiretoTitulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tesourodireto_titulos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('tipo_id');
            $table->string('nome', 64);
            $table->date('data_inicio')->nullable();
            $table->date('data_vencimento');

            $table->timestamps();

            $table->foreign('tipo_id')->references('id')->on('tesourodireto_tipos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tesourodireto_titulos');
    }
}
