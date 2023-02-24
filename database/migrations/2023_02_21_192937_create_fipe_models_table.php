<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('fipe_models', function (Blueprint $table) {
            $table->id();

            $table->string("codigoTabelaReferencia");
            $table->string("codigoTipoVeiculo");
            $table->string("codigoMarca");
            $table->string("Label");
            $table->string("Value");

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('fipe_models');
    }
};
