<?php

namespace App\Jobs;

use App\Enums\EndpointsFipeEnum;
use App\Enums\TypeVehicleEnum;
use App\Models\Fipe\FipeReference;
use App\Services\Fipe\FipeCurlService;
use Illuminate\Bus\Batch;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;
use Throwable;

class SearchFipeYearModelsJob implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    
    public function handle()
    {
        $models = EndpointsFipeEnum::selectType(EndpointsFipeEnum::year->name);

        $batches = [];

        foreach ($models as $model) {
            $postParams  = [
                "codigoTabelaReferencia"=> $model['codigoTabelaReferencia'],
                "codigoTipoVeiculo"=> $model['codigoTipoVeiculo'],
                "codigoMarca"=> $model['codigoMarca'],
                "codigoModelo"=> $model['codigoModelo']
            ];

            $class = EndpointsFipeEnum::year->value;

            $batches[] = new $class((array) $postParams);
        }


        $batch = Bus::batch($batches)->name('years')->then(function (Batch $batch) {
            Log::info("Job finalizado... Batch id: {$batch->id}");
        })->catch(function (Batch $batch, Throwable $e) {
            Log::error("Erro ao executar batch... Erro: {$e->getMessage()}");
        })->finally(function (Batch $batch) {
            Log::info("Batch finalizado... Batch id: {$batch->id}");
        })->dispatch();

        return $batch->id;
    }

   
}
