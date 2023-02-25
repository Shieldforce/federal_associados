<?php

namespace App\Http\Controllers\ApiPublic;

use App\Http\Resources\ChipPriceListPublicResource;
use App\Models\ChipPrice;
use App\Models\Plan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PlanListPublicResource;
use App\Models\Fipe\FipeBrand;
use App\Models\Fipe\FipeModel;
use App\Models\Fipe\FipeReference;

class FipeApiConsultController extends Controller
{

    public function getBrands(Request $request)
    {

        $reference = FipeReference::orderBy('created_at', 'desc')->first();
        $brands = FipeBrand::where('vehicleType', $request['vehicle_type'])->get();


        return response()->json(['data' => $brands], 200);
    }

    public function getModels(Request $request)
    {
        $reference = FipeReference::orderBy('created_at', 'desc')->first();
        $model = FipeModel::where('codigoTabelaReferencia', $reference->id)
            ->where('codigoMarca', $request['brand_code'])
            ->where('vehicleType', $request['vehicle_type']);

        if ($request['search']) {
            $model->where('Label', 'like', "%" . $request['search'] . "%");
        }

        return response()->json(['data' => $model], 200);
    }

    public function getYear(Request $request)
    {
        return ChipPriceListPublicResource::collection(
            isset($request['paginate']) && $request['paginate'] == 'false'
            ? ChipPrice::filter($request->all())->get() : ChipPrice::filter($request->all())->paginate(10)
        );

    }

    public function getVehicle(Request $request)
    {
        return ChipPriceListPublicResource::collection(
            isset($request['paginate']) && $request['paginate'] == 'false'
            ? ChipPrice::filter($request->all())->get() : ChipPrice::filter($request->all())->paginate(10)
        );

    }


}