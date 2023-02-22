<?php

namespace App\Models\Fipe;

use Illuminate\Database\Eloquent\Model;

class FipeBrand extends Model
{
    protected $table = "fipe_brands";

    protected  $fillable = [
        "Label",
	    "Value",
    ];
}
