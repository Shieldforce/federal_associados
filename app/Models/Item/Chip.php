<?php

namespace App\Models\Item;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

class Chip extends Model
{

    use Filterable;

    protected $table = "chips";

    protected $fillable = [
        "number_registration",
        "type",
    ];

    /**
     * Relations
     */

    public function item()
    {
        return $this->morphOne(Item::class, 'itemable');
    }
}
