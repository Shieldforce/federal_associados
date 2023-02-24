<?php

namespace App\Jobs\Fipe\References;

use App\Models\Fipe\FipeReference;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

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
        FipeReference::create([
            "Mes"       => $this->result["Mes"],
            "Codigo"    => $this->result["Codigo"],
        ]);
    }
}
