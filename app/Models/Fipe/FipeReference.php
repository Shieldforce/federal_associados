<?php

namespace App\Models\Fipe;

use Illuminate\Database\Eloquent\Model;

class FipeReference extends Model
{
    protected $table = "fipe_references";

    protected  $fillable = [
        "Mes",
        "Codigo",
    ];
}
