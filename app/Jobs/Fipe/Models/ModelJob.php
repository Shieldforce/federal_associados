<?php

namespace App\Jobs\Fipe\Models;

use App\Models\Fipe\FipeModel;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ModelJob implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $result;

    public $extraParams;
    public function __construct(array $result, $extraParams = [])
    {
        $this->result = $result;
        $this->extraParams = $extraParams;
    }

    public function handle()
    {
        FipeModel::create([
            "codigoTabelaReferencia"       => $this->extraParams["ReferenceValue"],
            "codigoTipoVeiculo"            => $this->extraParams["ReferenceType"],
            "codigoMarca"                  => $this->extraParams["Value"],
            "Label"                        => $this->result["Label"],
            "Value"                        => $this->result["Value"],
        ]);
    }
}
