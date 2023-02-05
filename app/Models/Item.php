<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{

    use Filterable;

    protected $fillable = [
        "itemable_type",
        "itemable_id",
        "order_id",
    ];
}
