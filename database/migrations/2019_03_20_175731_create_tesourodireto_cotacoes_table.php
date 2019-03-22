<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTesourodiretoCotacoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tesourodireto_cotacoes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('titulo_id');
            $table->date('data');
            $table->decimal('taxa_compra', 4, 2)->nullable();
            $table->decimal('taxa_venda', 4, 2)->nullable();
            $table->decimal('preco_compra', 7, 2)->nullable();
            $table->decimal('preco_venda', 7, 2)->nullable();
            $table->decimal('preco_base', 7, 2)->nullable();

            $table->timestamps();

            $table->foreign('titulo_id')->references('id')->on('tesourodireto_titulos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tesourodireto_cotacoes');
    }
}
