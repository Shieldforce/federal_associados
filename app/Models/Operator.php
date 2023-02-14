<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

class Operator extends Model
{

    protected $table = "operators";

    use Filterable;

    protected $fillable = [
        "name",
    ];

    /**
     * Relations
     */
    public function chipPrices()
    {
        return $this->hasMany(ChipPrice::class, "operator_id", "id");
    }
}
