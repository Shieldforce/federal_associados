<?php

namespace App\Jobs\Fipe;

use App\Models\Fipe\FipeReference;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Throwable;

class ReferenceJob implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $result;
    public function __construct(array $result)
    {
        $this->result = $result;
    }

    public function handle()
    {
        FipeReference::firstOrCreate([
            "Mes"       => $this->result["Mes"],
            "Codigo"    => $this->result["Codigo"],
        ]);
    }
}
