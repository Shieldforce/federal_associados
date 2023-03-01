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

class SearchFipeModelsJob implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    
    public function handle()
    {
        $brands = EndpointsFipeEnum::selectType(EndpointsFipeEnum::model->name);
        $modelos = [];

        $batches = [];
        foreach ($brands as $brand) {

            $postParams  = [
                "codigoTabelaReferencia"=> FipeReference::orderBy('created_at', 'desc')->first()->Codigo,
                "codigoTipoVeiculo"=> $brand['vehicleType'],
                "codigoMarca"=> $brand['Value']
            ];

            $results = FipeCurlService::run(
                EndpointsFipeEnum::methodResolve(EndpointsFipeEnum::model->name),
                EndpointsFipeEnum::enpointResolve(EndpointsFipeEnum::model->name),
                $postParams
            );


            $class = EndpointsFipeEnum::model->value;
            $postParams['Modelos'] = $results['Modelos'];
            $batches[] = new $class((array) $postParams);
        }

        $batch = Bus::batch($batches)->name('models')->then(function (Batch $batch) {
            Log::info("Job finalizado... Batch id: {$batch->id}");
        })->catch(function (Batch $batch, Throwable $e) {
            Log::error("Erro ao executar batch... Erro: {$e->getMessage()}");
        })->finally(function (Batch $batch) {
            Log::info("Batch finalizado... Batch id: {$batch->id}");
        })->dispatch();

        return $batch->id;
    }

   
}
