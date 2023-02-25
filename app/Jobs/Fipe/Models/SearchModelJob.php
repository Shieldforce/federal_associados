<?php

namespace App\Jobs\Fipe\Models;

use App\Enums\EndpointsFipeEnum;
use App\Models\Fipe\ControlJob;
use App\Models\Fipe\FipeBrand;
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

class SearchModelJob implements ShouldQueue
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
        foreach ($this->listSearchFields() as $index => $typeVehicleGroup) {
            $results = FipeCurlService::run(
                "POST",
                "/ConsultarModelos",
                $typeVehicleGroup
            );

            $incrementResults[$index] = $results;
        }

        $batches = [];

        foreach ($incrementResults as $tipoVeiculo => $result) {
            $batches[] = new ModelJob($this->controlJob, (array) $result["Modelos"], $this->listSearchFields()[$tipoVeiculo]);
        }

        Bus::batch($batches)->then(function (Batch $batch) {
        })->catch(function (Batch $batch, Throwable $e) {
        })->finally(function (Batch $batch) {
        })->dispatch();

    }

    private function listSearchFields()
    {
       return FipeBrand::get([
            "Value AS codigoMarca",
            "ReferenceValue AS codigoTabelaReferencia",
            "ReferenceType AS codigoTipoVeiculo",
        ])->toArray();
    }
}
