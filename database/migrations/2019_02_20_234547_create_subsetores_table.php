<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubsetoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subsetores', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('setor_id');
            $table->string('nome', 64);
            $table->unsignedInteger('created_by')->nullable();;
            $table->unsignedInteger('updated_by')->nullable();;
            $table->timestamps();

            $table->foreign('setor_id')->references('id')->on('setores');
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
        Schema::dropIfExists('subsetores');
    }
}
