<?php

namespace App\Jobs;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class RunBillingMonthlyUniqueOrderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Order $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function handle()
    {
        $items = $this->order->items()
            ->whereNotNull("itemable_id")
            ->where("reference", now()->from("m/Y"));

        foreach ($items as $item) {
            $this->order->billets()->create([
                "our_number" => "",
                "link"       => "",
                "bar_code"   => "",
                "order_id"   => "",
            ]);
        }
    }
}
