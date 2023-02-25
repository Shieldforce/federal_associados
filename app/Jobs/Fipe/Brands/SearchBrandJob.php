<?php

namespace App\Jobs\Fipe\Brands;

use App\Enums\EndpointsFipeEnum;
use App\Jobs\Fipe\Models\SearchModelJob;
use App\Models\Fipe\ControlJob;
use App\Models\Fipe\FipeModel;
use App\Models\Fipe\FipeReference;
use App\Services\Fipe\FipeCurlService;
use Illuminate\Bus\Batch;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;
use Throwable;

class SearchBrandJob implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public ControlJob $controlJob;

    public function __construct(ControlJob $controlJob)
    {
        $this->controlJob = $controlJob;
    }

    public function handle()
    {
        $incrementResults = [];
        $count = 0;
        foreach ($this->listSearchFields() as $index => $typeVehicleGroup) {
            $results = FipeCurlService::run(
                "POST",
                "/ConsultarMarcas",
                $typeVehicleGroup
            );

            $incrementResults[$index] = $results;
            $count += count($results);
        }

        $this->controlJob->update([
            "type" => EndpointsFipeEnum::brand->value,
            "total_count" => $count,
            "finish_count" => 0,
            "finish" => 0,
        ]);

        $batches = [];

        foreach ($incrementResults as $tipoVeiculo => $results) {
            foreach ($results as $result) {
                $batches[] = new BrandJob($this->controlJob, (array) $result, $this->listSearchFields()[$tipoVeiculo]);
            }
        }

        $batches[] = new SearchModelJob($this->controlJob);

        Bus::batch($batches)->then(function (Batch $batch) {
        })->catch(function (Batch $batch, Throwable $e) {
        })->finally(function (Batch $batch) {
        })->dispatch();

    }

    private function listSearchFields()
    {
        $reference = FipeReference::first();

        return [
            [
                "codigoTabelaReferencia" => $reference->Codigo,
                "codigoTipoVeiculo"      => 1 // Carro
            ],
            [
                "codigoTabelaReferencia" => $reference->Codigo,
                "codigoTipoVeiculo"      => 2 // Moto
            ],
            [
                "codigoTabelaReferencia" => $reference->Codigo,
                "codigoTipoVeiculo"      => 3 // Caminhão
            ],
        ];
    }
}
