<?php

namespace App\Jobs\Fipe;

use App\Models\Fipe\FipeBrand;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Throwable;

class BrandJob implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $result;
    public function __construct(array $result)
    {
        $this->result = $result;
    }

    public function handle()
    {
        FipeBrand::create([
            "Label"     => $this->result["Label"],
            "Value"     => $this->result["Value"],
        ]);
    }
}
