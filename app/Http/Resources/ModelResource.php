<?php

namespace App\Http\Resources;

use App\Models\Permission;
use Illuminate\Http\Resources\Json\JsonResource;

class ModelResource extends JsonResource
{
    public function toArray($request)
    {

        return [
            "codigoTabelaReferencia",
            "codigoTipoVeiculo",
            "codigoMarca",
            "codigoModelo",
            "label"
        ];
    }
}
