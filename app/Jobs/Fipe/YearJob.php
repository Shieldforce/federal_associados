<?php

namespace App\Jobs\Fipe;

use App\Models\Fipe\FipeModel;
use App\Models\Fipe\FipeYear;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Throwable;

class YearJob implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $result;
    public function __construct(array $result)
    {
        $this->result = $result;
    }

    public function handle()
    {
        foreach ($this->result["year"] as $item){
            $dado = explode("-",$item['Value']);
            FipeYear::updateOrCreate(
                [
                    "codigoModelo"              => $this->result['codigoModelo'],
                    "codigoTabelaReferencia"    => $this->result['codigoTabelaReferencia'],
                    "ano"                       => $item['Value']
                ],
                [
                    "codigoTabelaReferencia"    => $this->result['codigoTabelaReferencia'],
                    "codigoTipoVeiculo"         => $this->result['codigoTipoVeiculo'],
                    "codigoMarca"               => $this->result['codigoMarca'],
                    "codigoModelo"              => $this->result['codigoModelo'],
                    "Label"                     => $item['Label'],
                    "ano"                       => $item['Value'],
                    "codigoTipoCombustivel"     => $dado[1],
                    "anoModelo"                 => $dado[0]
                ]);
        }
    }
}
