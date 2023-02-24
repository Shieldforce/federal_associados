<?php

namespace App\Jobs\Fipe;

use App\Models\Fipe\FipeVehicle;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Throwable;

class VehicleJob implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public array $result;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public int $timeout = 1200;

    public function __construct(array $result)
    {
        $this->result = $result;
    }

    public function handle()
    {
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
