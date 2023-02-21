<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

class ChipPrice extends Model
{

    protected $table = "chip_prices";

    use Filterable;

    protected $fillable = [
        "name",
        "GB",
        "allow_voice",
        "allow_antenna",
        "price",
        "operator_id",
    ];

    protected $casts = [
        "allow_voice" => "boolean",
        "allow_antenna"  => "boolean",
        "price" => "float"
    ];

    /**
     * Relations
     */
    public function operator()
    {
        return $this->hasOne(Operator::class, "id", "operator_id");
    }
}
