<?php

namespace App\Jobs\Fipe\Models;

use App\Models\Fipe\ControlJob;
use App\Models\Fipe\FipeModel;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ModelJob implements ShouldQueue
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
            FipeModel::create([
                "codigoTabelaReferencia"       => $this->extraParams["codigoTabelaReferencia"],
                "codigoTipoVeiculo"            => $this->extraParams["codigoTipoVeiculo"],
                "codigoMarca"                  => $this->extraParams["codigoMarca"],
                "Label"                        => $this->result["Label"] ?? "Não veio",
                "Value"                        => $this->result["Value"] ?? "não veio",
            ]);
        /*}

        $this->controlJob->update([
            "finish_count" => $this->controlJob->finish_count + 1,
        ]);

        if($this->controlJob->finish_count == $this->controlJob->total_count) {
            $this->controlJob->finish = 1;
            $this->controlJob->save();

            //SearchModelJob::dispatch($this->controlJob);
        }

        return true;*/

    }
}
