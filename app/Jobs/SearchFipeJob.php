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

class SearchFipeJob implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected EndpointsFipeEnum $endpointsFipeEnum;

    public function __construct(EndpointsFipeEnum $endpointsFipeEnum)
    {
        $this->endpointsFipeEnum = $endpointsFipeEnum;
    }

    public function handle()
    {
        $consulVehicleTypeLimiter = $this->endpointsFipeEnum->name == EndpointsFipeEnum::reference->name
            ? 1
            : 3;


        $allResults = [];
        for ($vehicleType = 1; $vehicleType <= $consulVehicleTypeLimiter; $vehicleType++) {

            $results = FipeCurlService::run(
                $this->endpointsFipeEnum::methodResolve($this->endpointsFipeEnum->name),
                $this->endpointsFipeEnum::endpointResolve($this->endpointsFipeEnum->name),
                $this->endpointsFipeEnum::selectType($this->endpointsFipeEnum->name, $vehicleType)
            );

            if ($this->endpointsFipeEnum->name == EndpointsFipeEnum::reference->name) {
                $results = [$results[0]];
            }

            $arrayMap = array_map(function ($value) use ($vehicleType) {
                return [
                    "vehicleType" => $vehicleType,
                    ...$value
                ];
            }, $results);

            $allResults = array_merge($allResults, $arrayMap);
        }

        $batches = [];


        foreach ($allResults as $item) {

            $class = $this->endpointsFipeEnum->value;
            $batches[] = new $class((array)$item);
        }

        $batch = Bus::batch($batches)->name($this->endpointsFipeEnum->name)->then(function (Batch $batch) {
            Log::info("Job finalizado... Batch id: {$batch->id}");
        })->catch(function (Batch $batch, Throwable $e) {
            Log::error("Erro ao executar batch... Erro: {$e->getMessage()}");
        })->finally(function (Batch $batch) {
            Log::info("Batch finalizado... Batch id: {$batch->id}");
        })->dispatch();

        return $batch->id;
    }


}
