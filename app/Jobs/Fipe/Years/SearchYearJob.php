<?php

namespace App\Jobs\Fipe\Years;

use App\Enums\EndpointsFipeEnum;
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

class SearchYearJob implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected EndpointsFipeEnum $endpointsFipeEnum;

    public function __construct(EndpointsFipeEnum $endpointsFipeEnum)
    {
        $this->endpointsFipeEnum = $endpointsFipeEnum;
    }

    public function handle()
    {

        $results = FipeCurlService::run(
            $this->endpointsFipeEnum::methodResolve($this->endpointsFipeEnum->name),
            $this->endpointsFipeEnum::enpointResolve($this->endpointsFipeEnum->name),
            $this->selectType()
        );

        $batches = [];

        foreach ($results as $item) {
            $class = $this->endpointsFipeEnum->value;
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

    private function selectType()
    {
        if($this->endpointsFipeEnum->name == "reference") {
            return [];
        }

        if($this->endpointsFipeEnum->name == "brand") {
            return [
                "codigoTabelaReferencia" => 231,
                "codigoTipoVeiculo"      => 1
            ];
        }

        return [];
    }
}
