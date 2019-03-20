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
            $table->decimal('taxa_compra', 2, 2);
            $table->decimal('taxa_venda', 2, 2);
            $table->decimal('preco_compra', 5, 2);
            $table->decimal('preco_venda', 5, 2);
            $table->decimal('preco_base', 5, 2);

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
