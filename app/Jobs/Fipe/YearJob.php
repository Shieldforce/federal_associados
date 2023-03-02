<?php

namespace App\Jobs\Fipe;

use Throwable;
use App\Models\Fipe\FipeYear;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use App\Models\Fipe\FipeModel;
use App\Enums\EndpointsFipeEnum;
use App\Services\Fipe\FipeCurlService;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class YearJob implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public array $result;

    public function __construct(array $result)
    {
        $this->result = $result;
    }

    public function handle()
    {

        $results = FipeCurlService::run(
            EndpointsFipeEnum::methodResolve(EndpointsFipeEnum::year->name),
            EndpointsFipeEnum::endpointResolve(EndpointsFipeEnum::year->name),
            $this->result
        );

        $this->result["year"] = $results;

        foreach ($this->result["year"] as $item) {
            $dado = explode("-", $item['Value']);
            FipeYear::updateOrCreate(
                [
                    "codigoModelo"           => $this->result['codigoModelo'],
                    "codigoTabelaReferencia" => $this->result['codigoTabelaReferencia'],
                    "ano"                    => $item['Value']
                ],
                [
                    "codigoTabelaReferencia" => $this->result['codigoTabelaReferencia'],
                    "codigoTipoVeiculo"      => $this->result['codigoTipoVeiculo'],
                    "codigoMarca"            => $this->result['codigoMarca'],
                    "codigoModelo"           => $this->result['codigoModelo'],
                    "Label"                  => $item['Label'],
                    "ano"                    => $item['Value'],
                    "codigoTipoCombustivel"  => $dado[1],
                    "anoModelo"              => $dado[0]
                ]);
        }
    }
}
