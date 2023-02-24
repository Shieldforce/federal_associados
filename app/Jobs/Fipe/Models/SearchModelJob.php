<?php

namespace App\Jobs\Fipe\Models;

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

    public function handle()
    {
        Log::info(json_encode($this->listSearchFields()));

        foreach ($this->listSearchFields() as $execute) {

            Log::info("entrou no loop");

            $results = FipeCurlService::run(
                "POST",
                "/ConsultarModelos",
                $execute
            );

            $batches = [];

            foreach ($results as $item) {
                $batches[] = new ModelJob((array)$item, $execute);
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

        return FipeBrand::get([
            "Label",
            "Value",
            "ReferenceValue",
            "ReferenceType",
        ])->toArray();
    }
}
