<?php

namespace App\Jobs\Fipe\References;

use App\Jobs\Fipe\Brands\SearchBrandJob;
use App\Models\Fipe\ControlJob;
use App\Models\Fipe\FipeReference;
use Illuminate\Bus\Batch;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ReferenceJob implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public array $result;

    public ControlJob $controlJob;

    public function __construct(ControlJob $controlJob, array $result)
    {
        $this->controlJob = $controlJob;
        $this->result = $result;
    }

    public function handle()
    {
        //if($this->controlJob->finish_count <= $this->controlJob->total_count) {
            FipeReference::create([
                "Mes"       => $this->result["Mes"],
                "Codigo"    => $this->result["Codigo"],
            ]);
        /*}

        $this->controlJob->update([
            "finish_count" => $this->controlJob->finish_count + 1
        ]);

        if($this->controlJob->finish_count == $this->controlJob->total_count) {
            $this->controlJob->finish = 1;
            $this->controlJob->save();

            // Next job ---->

        }

        return true;*/
    }
}
