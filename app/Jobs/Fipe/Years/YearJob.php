<?php

namespace App\Jobs\Fipe\Years;

use App\Models\Fipe\FipeModel;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class YearJob implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $result;

    public $extraParams;
    public function __construct(array $result, $extraParams = [])
    {
        $this->result = $result;
        $this->extraParams = $extraParams;
    }

    public function handle()
    {

        Log::info(json_encode($this->result));

        /*FipeModel::create([
            "codigoTabelaReferencia"       => $this->extraParams["codigoTabelaReferencia"],
            "codigoTipoVeiculo"            => $this->extraParams["codigoTipoVeiculo"],
            "codigoMarca"                  => $this->extraParams["codigoMarca"],
            "codigoModelo"                 => $this->extraParams["codigoModelo"],
            "Label"                        => $this->result["Value"] ?? "não veio",
            "Value"                        => $this->result["Value"] ?? "não veio",
        ]);*/
    }
}
