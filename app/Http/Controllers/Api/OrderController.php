<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\OrderCreateRequest;
use App\Http\Requests\Order\OrderUpdateRequest;
use App\Http\Resources\OrderListResource;
use App\Models\Order;
use Illuminate\Http\Request;

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

    
}
