<?php

namespace App\Jobs;

use App\Enums\StatusEnum;
use App\Models\Order;
use Illuminate\Bus\Batch;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Bus;
use Throwable;

class BillingMonthlyPayJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public string $reference;

    public function __construct(string $reference)
    {
        $this->reference = $reference;
    }

    public function handle()
    {
        $orders = Order::where("status", StatusEnum::PAGA->value)->get();

        $batches = [];

        foreach ($orders as $order) {
            $batches[] = new RunBillingMonthlyUniqueOrderJob($order);
        }

        $batch = Bus::batch($batches)->name('BillingMonthlyPayBatch')->then(function (Batch $batch) {
        })->catch(function (Batch $batch, Throwable $e) {
        })->finally(function (Batch $batch) {
        })->dispatch();
        return $batch->id;
    }
}
