<?php

namespace App\Models\Fipe;

use Illuminate\Database\Eloquent\Model;

class FipeVehicle extends Model
{
    protected $table = "fipe_vehicles";

    protected  $fillable = [
        "codigoTabelaReferencia",
        "codigoTipoVeiculo",
        "codigoMarca",
        "codigoModelo",
        "ano",
        "codigoTipoCombustivel",
        "anoModelo",
    ];
}
