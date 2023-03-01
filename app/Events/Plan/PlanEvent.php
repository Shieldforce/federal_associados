<?php

namespace App\Events\Plan;

use App\Models\Plan;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Http\Request;
use Illuminate\Queue\SerializesModels;

class PlanEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Request $request;

    public Plan $plan;
    public function __construct(Request $request, Plan $plan)
    {
        $this->request = $request;
        $this->plan = $plan;
    }
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
