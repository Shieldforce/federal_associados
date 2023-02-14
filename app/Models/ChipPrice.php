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
        "price",
        "operator_id",
    ];

    /**
     * Relations
     */
    public function operator()
    {
        return $this->hasOne(Operator::class, "id", "operator_id");
    }
}
