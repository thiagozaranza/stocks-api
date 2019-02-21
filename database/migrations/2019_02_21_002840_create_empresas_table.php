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
            $table->string('segmento', 3)->unique();
            $table->string('razao_social', 32)->unique();
            $table->string('cnpj', 18)->unique();
            $table->string('nire', 15)->unique();
            $table->string('isin', 15)->unique();
            $table->string('cvm', 10)->unique();
            $table->string('site', 64);
            $table->string('pais', 16);
            $table->string('atividade', 256);
            $table->date('data_constituicao');
            $table->date('data_registro_cvm');
            $table->unsignedInteger('created_by');
            $table->unsignedInteger('updated_by');
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
