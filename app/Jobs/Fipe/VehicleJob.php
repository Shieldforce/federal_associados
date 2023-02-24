<?php

namespace App\Jobs\Fipe;

use Throwable;
use App\Models\Fipe\FipeYear;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use App\Enums\EndpointsFipeEnum;
use App\Models\Fipe\FipeVehicle;
use App\Services\Fipe\FipeCurlService;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class VehicleJob implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public array $result;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public int $timeout = 120;

    public function __construct(array $result)
    {
        $this->result = $result;
    }

    public function handle()
    {
        $results = FipeCurlService::run(
            EndpointsFipeEnum::methodResolve(EndpointsFipeEnum::vehicle->name),
            EndpointsFipeEnum::enpointResolve(EndpointsFipeEnum::vehicle->name),
            $this->result
        );
        $this->result['vehicle'] = $results;
        
            FipeVehicle::updateOrCreate(
                [
                    "codigoModelo" => $this->result['codigoModelo'],
                    "codigoTabelaReferencia" => $this->result['codigoTabelaReferencia'],
                    "ano" => $this->result['ano']
                ],
                [
                    "codigoTabelaReferencia"    => $this->result['codigoTabelaReferencia'],
                    "codigoTipoVeiculo"         => $this->result['codigoTipoVeiculo'],
                    "codigoMarca"               => $this->result['codigoMarca'],
                    "codigoModelo"              => $this->result['codigoModelo'],
                    "ano"                       => $this->result['ano'],
                    "codigoTipoCombustivel"     => $this->result['codigoTipoCombustivel'],
                    "anoModelo"                 => $this->result['anoModelo'],
                    "Valor"                     => $this->result["vehicle"]['Valor'],
                    "Marca"                     => $this->result["vehicle"]['Marca'],
                    "Modelo"                    => $this->result["vehicle"]['Modelo'],
                    "Combustivel"               => $this->result["vehicle"]['Combustivel'],
                    "CodigoFipe"                => $this->result["vehicle"]['CodigoFipe'],
                    "MesReferencia"             => $this->result["vehicle"]['MesReferencia'],
                    "Autenticacao"              => $this->result["vehicle"]['Autenticacao'],
                    "TipoVeiculo"               => $this->result["vehicle"]['TipoVeiculo'],
                    "SiglaCombustivel"          => $this->result["vehicle"]['SiglaCombustivel'],
                    "DataConsulta"              => $this->result["vehicle"]['DataConsulta'],
                ]);
    }
}




