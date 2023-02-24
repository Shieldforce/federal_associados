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


            $modelos = array_merge($modelos,  $results['Modelos']);
        }
        $batches = [];
        
        foreach ($modelos as $item) {
            $class = EndpointsFipeEnum::model->value;
            $item['codigoTabelaReferencia'] = FipeReference::orderBy('created_at', 'desc')->first()->Codigo;   
            $item['codigoTipoVeiculo'] = $brand['vehicleType'];
            $batches[] = new $class((array) $item);
        }

        $batch = Bus::batch($batches)->then(function (Batch $batch) {
            Log::info("Job finalizado... Batch id: {$batch->id}");
        })->catch(function (Batch $batch, Throwable $e) {
            Log::error("Erro ao executar batch... Erro: {$e->getMessage()}");
        })->finally(function (Batch $batch) {
            Log::info("Batch finalizado... Batch id: {$batch->id}");
        })->dispatch();

        return $batch->id;
    }

   
}
