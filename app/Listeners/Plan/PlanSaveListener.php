<?php

namespace App\Listeners\Plan;

use App\Models\Allowed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PlanSaveListener
{

    public function __construct()
    {
        //
    }


    public function handle($event)
    {
        $request = $event->request;
        foreach ($request->alloweds as $allowed) {
            $allowed["plan_id"] = $event->plan->id ?? null;
            $allowedUpdate = $allowed;
            if(isset($allowed["id"])) {
                $allowedUpdate = ["id" => $allowed["id"]];
            }
            Allowed::updateOrCreate($allowedUpdate, $allowedUpdate);
        }
    }
}
