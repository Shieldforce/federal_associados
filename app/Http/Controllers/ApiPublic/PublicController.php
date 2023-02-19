<?php

namespace App\Http\Controllers\ApiPublic;

use App\Models\Plan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PlanListPublicResource;

class PublicController extends Controller
{

    public function getPlans(Request $request)
    {
        return PlanListPublicResource::collection(
            Plan::filter($request->all())->paginate(10)
        );

    }
 
}
