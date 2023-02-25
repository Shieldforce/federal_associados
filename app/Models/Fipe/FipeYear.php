<?php

namespace App\Models\Fipe;

use Illuminate\Database\Eloquent\Model;

class FipeYear extends Model
{
    protected $table = "fipe_years";

    protected  $fillable = [
        "codigoTabelaReferencia",
        "codigoTipoVeiculo",
        "codigoMarca",
        "codigoModelo",
        "Label",
        "ano",
        "codigoTipoCombustivel",
        "anoModelo"
    ];
}
