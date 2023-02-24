<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\AuditorOfChipActiveRequest;
use App\Http\Requests\Order\OrderCreateRequest;
use App\Http\Requests\Order\OrderUpdateRequest;
use App\Http\Resources\OrderListResource;
use App\Jobs\AuditorOfChipsActivesJob;
use App\Jobs\StartAuditorOfChipsActivesJob;
use App\Models\Order;
use App\Models\SystemOld\ChipSystemOld;
use App\Models\SystemOld\OrderSystemOld;
use App\Models\SystemOld\UserSystemOld;
use App\Services\ChipsService;
use Illuminate\Bus\Batch;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        return OrderListResource::collection(
            Order::filter($request->all())->paginate(10)
        );
    }

    public function store(OrderCreateRequest $request)
    {
        $data = $request->validated();
        $order = Order::create($data);
        return new OrderListResource($order);
    }

    public function show(Order $order)
    {
        return new OrderListResource($order);
    }

    public function update(OrderUpdateRequest $request, Order $order)
    {
        $data = $request->validated();
        $order->update($data);
        return new OrderListResource($order);
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return response()->json(200);
    }

    public function auditorOfChipsActives(AuditorOfChipActiveRequest $request)
    {
        StartAuditorOfChipsActivesJob::dispatch($request->iccids);

        /*$teste = new StartAuditorOfChipsActivesJob($request->iccids);
        $teste->handle();*/
    }




}
