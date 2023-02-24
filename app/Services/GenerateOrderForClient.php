<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class GenerateOrderForClient
{


public function __construct()
{
  
}



  $firstCalc = Plan::find($data['plan_id'])->alloweds()
  ?->where('rule', 0)->where('required', true)
  ?->pluck('value')->toArray();

if(count($firstCalc) > 0) {
  $firstCalc = array_sum($firstCalc);
}

$dinamycItems = Plan::find($data['plan_id'])->alloweds()?->where('rule', 1)->where('required', true)->get();
foreach ($dinamycItems as $item) {
 
}

}