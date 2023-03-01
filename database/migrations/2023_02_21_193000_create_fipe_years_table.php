<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fipe_years', function (Blueprint $table) {
            $table->id();

            $table->string("codigoTabelaReferencia");
            $table->string("codigoTipoVeiculo");
            $table->string("codigoMarca");
            $table->string("codigoModelo");
            $table->string("Label");
            $table->string("ano");
            $table->string("codigoTipoCombustivel");
            $table->string("anoModelo");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fipe_years');
    }
};
