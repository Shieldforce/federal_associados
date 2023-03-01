<?php

namespace App\Providers;

use App\Events\Order\OrderEvent;
use App\Events\Plan\PlanEvent;
use App\Listeners\Order\OrderSaveListener;
use App\Listeners\Plan\PlanSaveListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{

    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        PlanEvent::class => [
            PlanSaveListener::class
        ],
        OrderEvent::class => [
            OrderSaveListener::class
        ],
    ];

    public function boot()
    {
        //
    }

    public function shouldDiscoverEvents()
    {
        return false;
    }
}
