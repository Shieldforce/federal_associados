<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChipPrice\ChipPriceCreateRequest;
use App\Http\Requests\ChipPrice\ChipPriceUpdateRequest;
use App\Http\Resources\ChipPriceListResource;
use App\Models\ChipPrice;
use Illuminate\Http\Request;

class ChipPriceController extends Controller
{
    public function index(Request $request)
    {
        return ChipPriceListResource::collection(
            isset($request['paginate']) && $request['paginate'] == 'false' 
             ? ChipPrice::filter($request->all())->get() : ChipPrice::filter($request->all())->paginate(10)
        );
    }

    public function store(ChipPriceCreateRequest $request)
    {
        $data = $request->validated();
        $chipPrice = ChipPrice::create($data);
        return new ChipPriceListResource($chipPrice);
    }

    public function show(ChipPrice $chipPrice)
    {
        return new ChipPriceListResource($chipPrice);
    }

    public function update(ChipPriceUpdateRequest $request, ChipPrice $chipPrice)
    {
        $data = $request->validated();
        $chipPrice->update($data);
        return new ChipPriceListResource($chipPrice);
    }

    public function destroy(ChipPrice $chipPrice)
    {
        $chipPrice->delete();
        return response()->json(200);
    }
}
