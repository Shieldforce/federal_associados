<?php

namespace App\Jobs\Fipe\Years;

use App\Models\Fipe\FipeModel;
use App\Services\Fipe\FipeCurlService;
use Illuminate\Bus\Batch;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Bus;
use Throwable;

class SearchYearJob implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        foreach ($this->listSearchFields() as $execute) {

            $results = FipeCurlService::run(
                "POST",
                "/ConsultarAnoModelo",
                $execute
            );

            $batches = [];

            foreach ($results as $item) {
                $batches[] = new YearJob((array)$item, $execute);
            }

            Bus::batch($batches)->then(function (Batch $batch) {
                //Log::info("Job finalizado... Batch id: {$batch->id}");
            })->catch(function (Batch $batch, Throwable $e) {
                //Log::error("Erro ao executar batch... Erro: {$e->getMessage()}");
            })->finally(function (Batch $batch) {
                //Log::info("Batch finalizado... Batch id: {$batch->id}");
            })->dispatch();

        }

    }

    private function listSearchFields()
    {
        sleep(60);

        return FipeModel::get([
            "Value AS codigoModelo",
            "codigoTabelaReferencia",
            "codigoTipoVeiculo",
            "codigoMarca",
        ])->toArray();
    }
}
