<?php

namespace App\Http\Controllers;

use App\Enums\EndpointsFipeEnum;
use App\Jobs\Fipe\References\SearchFipeJob;
use App\Models\SystemOld\UserSystemOld;
use Illuminate\Bus\Batch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\DB;
use Throwable;

class testController extends Controller
{
    public function test(Request $request)
    {
        $itens = array();
        $nivel1 = UserSystemOld::where("user_id_pai", "7553")->where("user_status", "!=", "2")->get();
        $nivel2 = UserSystemOld::whereIn("user_id_pai", $nivel1->pluck("user_id"))->where("user_status", "!=", "2")->get();
        $itens["nivel2"] = UserSystemOld::select(DB::raw("user_id_pai, count(*) as total_value"))->whereIn("user_id_pai", $nivel1->pluck("user_id"))->where("user_status", "!=", "2")
            ->whereBetween("user_data", ["2022-11-01", "2023-02-20"])->groupBy("user_id_pai")->get()->toArray();
        $nivel3 = UserSystemOld::whereIn("user_id_pai", $nivel2->pluck("user_id"))->where("user_status", "!=", "2")->get();
        $itens["nivel3"] = UserSystemOld::select(DB::raw("user_id_pai, count(*) as total_value"))->whereIn("user_id_pai", $nivel2->pluck("user_id"))->where("user_status", "!=", "2")
            ->whereBetween("user_data", ["2022-11-01", "2023-02-20"])->groupBy("user_id_pai")->get()->toArray();
        $nivel4 = UserSystemOld::whereIn("user_id_pai", $nivel3->pluck("user_id"))->where("user_status", "!=", "2")->get();
        $itens["nivel4"] = UserSystemOld::select(DB::raw("user_id_pai, count(*) as total_value"))->whereIn("user_id_pai", $nivel4->pluck("user_id"))->where("user_status", "!=", "2")
            ->whereBetween("user_data", ["2022-11-01", "2023-02-20"])->groupBy("user_id_pai")->get()->toArray();
        $nivel5 = UserSystemOld::whereIn("user_id_pai", $nivel4->pluck("user_id"))->where("user_status", "!=", "2")->get();
        $itens["nivel5"] = UserSystemOld::select(DB::raw("user_id_pai, count(*) as total_value"))->whereIn("user_id_pai", $nivel5->pluck("user_id"))->where("user_status", "!=", "2")
            ->whereBetween("user_data", ["2022-11-01", "2023-02-20"])->groupBy("user_id_pai")->get()->toArray();
        $nivel6 = UserSystemOld::whereIn("user_id_pai", $nivel5->pluck("user_id"))->where("user_status", "!=", "2")->get();
        $itens["nivel6"] = UserSystemOld::select(DB::raw("user_id_pai, count(*) as total_value"))->whereIn("user_id_pai", $nivel6->pluck("user_id"))->where("user_status", "!=", "2")
            ->whereBetween("user_data", ["2022-11-01", "2023-02-20"])->groupBy("user_id_pai")->get()->toArray();
        $nivel7 = UserSystemOld::whereIn("user_id_pai", $nivel6->pluck("user_id"))->where("user_status", "!=", "2")->get();
        $itens["nivel7"] = UserSystemOld::select(DB::raw("user_id_pai, count(*) as total_value"))->whereIn("user_id_pai", $nivel7->pluck("user_id"))->where("user_status", "!=", "2")
            ->whereBetween("user_data", ["2022-11-01", "2023-02-20"])->groupBy("user_id_pai")->get()->toArray();
        $nivel8 = UserSystemOld::whereIn("user_id_pai", $nivel7->pluck("user_id"))->where("user_status", "!=", "2")->get();
        $itens["nivel8"] = UserSystemOld::select(DB::raw("user_id_pai, count(*) as total_value"))->whereIn("user_id_pai", $nivel8->pluck("user_id"))->where("user_status", "!=", "2")
            ->whereBetween("user_data", ["2022-11-01", "2023-02-20"])->groupBy("user_id_pai")->get()->toArray();
        $nivel9 = UserSystemOld::whereIn("user_id_pai", $nivel8->pluck("user_id"))->where("user_status", "!=", "2")->get();
        $itens["nivel9"] = UserSystemOld::select(DB::raw("user_id_pai, count(*) as total_value"))->whereIn("user_id_pai", $nivel9->pluck("user_id"))->where("user_status", "!=", "2")
            ->whereBetween("user_data", ["2022-11-01", "2023-02-20"])->groupBy("user_id_pai")->get()->toArray();
        $nivel10 = UserSystemOld::whereIn("user_id_pai", $nivel9->pluck("user_id"))->where("user_status", "!=", "2")->get();
        $itens["nivel10"] = UserSystemOld::select(DB::raw("user_id_pai, count(*) as total_value"))->whereIn("user_id_pai", $nivel10->pluck("user_id"))->where("user_status", "!=", "2")
            ->whereBetween("user_data", ["2022-11-01", "2023-02-20"])->groupBy("user_id_pai")->get()->toArray();
        dd(array_merge($itens["nivel2"], $itens["nivel3"], $itens["nivel4"], $itens["nivel5"]));

    }

    public function test2()
    {
        $batches = [
            new SearchFipeJob(EndpointsFipeEnum::reference),
            new SearchFipeJob(EndpointsFipeEnum::brand),
        ];

        $batch = Bus::batch($batches)->then(function (Batch $batch) {
        })->catch(function (Batch $batch, Throwable $e) {
        })->finally(function (Batch $batch) {
        })->dispatch();

        dd($batch->id);
    }
}
