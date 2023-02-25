<?php

namespace App\Jobs\Fipe\References;

use App\Enums\EndpointsFipeEnum;
use App\Jobs\Fipe\Brands\SearchBrandJob;
use App\Models\Fipe\ControlJob;
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

    public ControlJob $controlJob;

    public function __construct(ControlJob $controlJob)
    {
        $this->controlJob = $controlJob;
    }

    public function handle()
    {
        $results = FipeCurlService::run(
            "POST",
            "/ConsultarTabelaDeReferencia",
            $this->listSearchFields()
        );

        $batches = [];

        $this->controlJob->update([
            "total_count" => count($results),
        ]);

        foreach ($results as $item) {

            $batches[] = new ReferenceJob($this->controlJob, (array) $item);
        }

        $batches[] = new SearchBrandJob($this->controlJob);

        $batch = Bus::batch($batches)->then(function (Batch $batch) {
        })->catch(function (Batch $batch, Throwable $e) {
        })->finally(function (Batch $batch) {

        })->dispatch();

        return $batch->id;
    }

    private function listSearchFields()
    {
        return [];
    }
}
