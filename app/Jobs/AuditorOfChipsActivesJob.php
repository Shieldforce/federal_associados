<?php

namespace App\Jobs;

use App\Models\SystemOld\AuditorOfChipActiveSystemOld;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AuditorOfChipsActivesJob implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public array $data;
    public function __construct(array $data)
    {
        $this->data = $data;
    }
    public function handle()
    {
        AuditorOfChipActiveSystemOld::create($this->data);
    }
}
