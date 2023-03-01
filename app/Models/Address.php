<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{

    protected $table = "address";

    protected  $fillable = [
        "model_id",
        "relative_model",
        "cep",
        "address",
        "number",
        "district",
        "city",
        "state",
        "complement",
        'refer_point'
    ];


    public function addressable()
    {
        return $this->morphTo();
    }
}
