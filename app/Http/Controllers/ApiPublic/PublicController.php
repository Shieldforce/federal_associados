<?php

namespace App\Http\Controllers\ApiPublic;

use App\Http\Resources\ChipPriceListPublicResource;
use App\Models\ChipPrice;
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

    public function getChipPrices(Request $request)
    {
        return ChipPriceListPublicResource::collection(
            isset($request['paginate']) && $request['paginate'] == 'false'
                ? ChipPrice::filter($request->all())->get() : ChipPrice::filter($request->all())->paginate(10)
        );

    }

}
