<?php

namespace App\Jobs\Fipe\Brands;

use App\Models\Fipe\FipeBrand;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class BrandJob implements ShouldQueue
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
        FipeBrand::create([
            "Label"            => $this->result["Label"],
            "Value"            => $this->result["Value"],
            "ReferenceValue"   => $this->extraParams["codigoTabelaReferencia"],
            "ReferenceType"    => $this->extraParams["codigoTipoVeiculo"],
        ]);
    }
}
