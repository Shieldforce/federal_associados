<?php

namespace App\Models\Fipe;

use Illuminate\Database\Eloquent\Model;

class ControlJob extends Model
{
    protected $table = "control_jobs";

    protected  $fillable = [
	    "type",
	    "total_count",
	    "finish_count",
	    "finish",
    ];
}
