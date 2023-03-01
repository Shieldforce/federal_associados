<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Billing\BillingCreateRequest;
use App\Jobs\BillingMonthlyPayJob;

class BillingController extends Controller
{
    public function monthly(BillingCreateRequest $request)
    {
        $validated = $request->validated();
        BillingMonthlyPayJob::dispatch($validated["reference"]);

        return response()->json(true);
    }
}
