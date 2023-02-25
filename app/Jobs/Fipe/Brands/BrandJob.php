<?php

namespace App\Jobs\Fipe\Brands;

use App\Jobs\Fipe\Models\SearchModelJob;
use App\Models\Fipe\ControlJob;
use App\Models\Fipe\FipeBrand;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class BrandJob implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $result;

    public $extraParams;

    public ControlJob $controlJob;


    public function __construct(ControlJob $controlJob, array $result, $extraParams = [])
    {
        $this->controlJob = $controlJob;
        $this->result = $result;
        $this->extraParams = $extraParams;
    }

    public function handle()
    {
        //if($this->controlJob->finish_count <= $this->controlJob->total_count) {
            FipeBrand::create([
                "Label"            => $this->result["Label"] ?? null,
                "Value"            => $this->result["Value"] ?? null,
                "ReferenceValue"   => $this->extraParams["codigoTabelaReferencia"] ?? null,
                "ReferenceType"    => $this->extraParams["codigoTipoVeiculo"] ?? null,
            ]);
        /*}

        $this->controlJob->update([
            "finish_count" => $this->controlJob->finish_count + 1
        ]);

        if($this->controlJob->finish_count == $this->controlJob->total_count) {
            $this->controlJob->finish = 1;
            $this->controlJob->save();

            // Next job ---->
            //SearchModelJob::dispatch($this->controlJob)->onQueue("SearchModelJob");
        }

        return true;*/
    }
}
