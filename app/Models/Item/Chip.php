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

    public function item()
    {
        return $this->morphOne(Item::class, 'itemable');
    }
}