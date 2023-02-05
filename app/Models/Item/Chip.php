<?php

namespace App\Models\Item;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

class Chip extends Model
{

    use Filterable;

    protected $fillable = [

    ];

    /**
     * Relations
     */

    public function itemables()
    {
        return $this->morphMany(Item::class, 'itemable');
    }
}
