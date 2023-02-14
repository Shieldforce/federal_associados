<?php

namespace App\Models\Item;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

class Tracker extends Model
{

    use Filterable;

    protected $table = "trackers";

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
