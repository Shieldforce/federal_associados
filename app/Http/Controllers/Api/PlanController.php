<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Plan\PlanCreateRequest;
use App\Http\Requests\Plan\PlanUpdateRequest;
use App\Http\Requests\SaveFileRequest;
use App\Http\Resources\PlanListResource;
use App\Models\Plan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index(Request $request)
    {
        return PlanListResource::collection(
            Plan::filter($request->all())->paginate(10)
        );
    }

    public function store(PlanCreateRequest $request)
    {
        $data = $request->validated();
        $plan = Plan::create($data);
        return new PlanListResource($plan);
    }

    public function saveFile(SaveFileRequest $request, Plan $plan)
    {
        $plan->update($request->safe()->only(["file_link"]));
        return new PlanListResource($plan);
    }

    public function show(Plan $plan)
    {
        return new PlanListResource($plan);
    }

    public function update(PlanUpdateRequest $request, Plan $plan)
    {
        $data = $request->validated();
        $plan->update($data);
        return new PlanListResource($plan);
    }

    public function destroy(Plan $plan)
    {
        $plan->delete();
        return response()->json(200);
    }
}
