<?php

namespace App\Models\Fipe;

use Illuminate\Database\Eloquent\Model;

class FipeModel extends Model
{
    protected $table = "fipe_models";

    protected  $fillable = [
        "codigoTabelaReferencia",
        "codigoTipoVeiculo",
        "codigoMarca",
    ];
}
