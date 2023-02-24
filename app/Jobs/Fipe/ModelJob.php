<?php

namespace App\Jobs\Fipe;

use App\Models\Fipe\FipeModel;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Throwable;

class ModelJob implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $result;

    public function __construct(array $result)
    {
        $this->result = $result;
    }

    public function handle()
    {
        FipeModel::firstOrCreate([
            "codigoTabelaReferencia"    => $this->result['codigoTabelaReferencia'],
            "codigoTipoVeiculo"         => $this->result['codigoTipoVeiculo'],
            "codigoMarca"               => $this->result['Value'],
            "label"                     =>$this->result['Label']
        ]);
    }
}
