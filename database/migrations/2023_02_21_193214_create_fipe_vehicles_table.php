<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fipe_vehicles', function (Blueprint $table) {
            $table->id();

            $table->string("codigoTabelaReferencia");
            $table->string("codigoTipoVeiculo");
            $table->string("codigoMarca");
            $table->string("codigoModelo");
            $table->string("ano");
            $table->string("codigoTipoCombustivel");
            $table->string("anoModelo");
            $table->string("Valor");
            $table->decimal("ValorReal", 12, 2);
            $table->string("Marca");
            $table->string("Modelo");
            $table->string("Combustivel");
            $table->string("CodigoFipe");
            $table->string("MesReferencia");
            $table->string("Autenticacao");
            $table->string("TipoVeiculo");
            $table->string("SiglaCombustivel");
            $table->string("DataConsulta");

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
        Schema::dropIfExists('fipe_vehicles');
    }
};