<?php

namespace App\Listeners\Order;

use App\Models\Item\Item;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class OrderSaveListener
{

    public function __construct()
    {
        //
    }


    public function handle($event)
    {
        $request = $event->request;
        foreach ($request->items as $item) {



            Item::updateOrCreate($item, $item);
        }
    }
}
