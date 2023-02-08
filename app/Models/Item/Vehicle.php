<?php

namespace App\Models\Item;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{

    use Filterable;

    protected $table = "vehicles";

    protected $fillable = [
        "number_registration"
    ];

    /**
     * Relations
     */

    public function item()
    {
        return $this->morphOne(Item::class, 'itemable');
    }
}
