<?php

namespace App\Http\Controllers\Api;

use App\Enums\EndpointsFipeEnum;
use App\Http\Controllers\Controller;
use App\Jobs\Fipe\References\SearchReferenceJob;
use App\Models\Fipe\ControlJob;
use Illuminate\Http\Request;

class ExecuteJobController extends Controller
{
    public function run(Request $request)
    {
        $controlJob = ControlJob::create([
            "type"           => EndpointsFipeEnum::reference->value,
            "total_count"    => 1,
            "finish_count"   => 0,
        ]);

        SearchReferenceJob::dispatch($controlJob)->afterCommit();
    }
}
