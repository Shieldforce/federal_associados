<?php

namespace App\Http\Controllers\Api;

use App\Events\Plan\PlanEvent;
use App\Http\Requests\Plan\PlanCreateRequest;
use App\Http\Requests\Plan\PlanUpdateRequest;
use App\Http\Requests\SaveFileRequest;
use App\Http\Resources\PlanListResource;
use App\Models\Plan;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $plan = Plan::create($data);
            event(new PlanEvent($request, $plan));
            DB::commit();
            return new PlanListResource($plan);
        } catch (Exception $exception) {
            DB::rollBack();
            return $exception;
        }
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
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $plan->update($data);
            event(new PlanEvent($request, $plan));
            DB::commit();
            return new PlanListResource($plan);
        } catch (Exception $exception) {
            DB::rollBack();
            return $exception;
        }
    }

    public function destroy(Plan $plan)
    {
        $plan->delete();
        return response()->json(200);
    }
}
