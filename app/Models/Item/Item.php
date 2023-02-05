<?php

namespace App\Models\Item;

use App\Models\Order;
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

    /**
     * Relations
     */
    public function itemable()
    {
        return $this->morphTo();
    }

    public function order()
    {
        return $this->hasMany(Order::class, "id", "order_id");
    }
}
