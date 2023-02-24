<?php

namespace App\Jobs\Fipe;

use App\Models\Fipe\FipeModel;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Throwable;

class ModelJob implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $result;

    public function __construct(array $result)
    {
        $this->result = $result;
    }

    public function handle()
    {
        foreach ($this->result["Modelos"] as $modelo){
            FipeModel::updateOrCreate(
                ["codigoModelo"              => $modelo['Value'], "codigoTabelaReferencia" => $this->result['codigoTabelaReferencia']],
                [
                "codigoTabelaReferencia"    => $this->result['codigoTabelaReferencia'],
                "codigoTipoVeiculo"         => $this->result['codigoTipoVeiculo'],
                "codigoMarca"               => $this->result['codigoMarca'],
                "codigoModelo"              => $modelo['Value'],
                "label"                     => $modelo['Label']
            ]);
        }

    }
}
