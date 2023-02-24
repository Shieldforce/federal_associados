<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\Fipe\References\SearchReferenceJob;
use App\Jobs\Fipe\Brands\SearchBrandJob;
use App\Jobs\Fipe\Models\SearchModelJob;
use App\Jobs\Fipe\Years\SearchYearJob;
use App\Jobs\Fipe\Vehicles\SearchVehicleJob;
use Illuminate\Bus\Batch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;
use Throwable;

class ExecuteJobController extends Controller
{
    public function run(Request $request)
    {
        $reference = $request->reference ?? null;

        $batches = [
            new SearchReferenceJob(),
            new SearchBrandJob($reference),
            new SearchModelJob(),
            //new SearchYearJob(),
            //new SearchVehicleJob(),
        ];

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
