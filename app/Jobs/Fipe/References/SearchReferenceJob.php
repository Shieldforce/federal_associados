<?php

namespace App\Jobs\Fipe\References;

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

class SearchReferenceJob implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {

        $results = FipeCurlService::run(
            "POST",
            "/ConsultarTabelaDeReferencia",
            $this->listSearchFields()
        );

        $batches = [];

        foreach ($results as $item) {
            $batches[] = new ReferenceJob((array) $item);
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

    private function listSearchFields()
    {
        return [];
    }
}
