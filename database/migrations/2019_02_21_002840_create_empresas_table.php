<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('segmento_id');
            $table->string('nome', 32)->unique();
            $table->string('codigo', 64)->unique();
            $table->string('subsegmento', 3)->nullable();;
            $table->string('razao_social', 32)->nullable();;
            $table->string('cnpj', 18)->unique()->nullable();;
            $table->string('nire', 15)->unique()->nullable();;
            $table->string('isin', 15)->unique()->nullable();;
            $table->string('cvm', 10)->unique()->nullable();;
            $table->string('site', 64)->nullable();;
            $table->string('pais', 16)->nullable();;
            $table->string('atividade', 256)->nullable();;
            $table->date('data_constituicao')->nullable();;
            $table->date('data_registro_cvm')->nullable();;
            $table->unsignedInteger('created_by')->nullable();;
            $table->unsignedInteger('updated_by')->nullable();;
            $table->timestamps();

            $table->foreign('segmento_id')->references('id')->on('segmentos');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empresas');
    }
}
