<?php

namespace App\Jobs\Fipe\Brands;

use App\Enums\EndpointsFipeEnum;
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

    protected string $reference;

    public function __construct(string $reference = null)
    {
        $this->reference = $reference;
        $this->endpointsFipeEnum = EndpointsFipeEnum::brand;
    }

    public function handle()
    {
        foreach ($this->listSearchFields() as $execute) {

            $results = FipeCurlService::run(
                "POST",
                "/ConsultarMarcas",
                $execute
            );

            $batches = [];

            foreach ($results as $item) {
                $batches[] = new BrandJob((array) $item, $execute);
            }

            Bus::batch($batches)->then(function (Batch $batch) {
                Log::info("Job finalizado... Batch id: {$batch->id}");
            })->catch(function (Batch $batch, Throwable $e) {
                Log::error("Erro ao executar batch... Erro: {$e->getMessage()}");
            })->finally(function (Batch $batch) {
                Log::info("Batch finalizado... Batch id: {$batch->id}");
            })->dispatch();

        }
    }

    private function listSearchFields()
    {
        sleep(5);

        $reference = FipeReference::where("Mes", $this->reference)->first();

        if(!isset($reference)) {
            $reference = FipeReference::first();
        }

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
