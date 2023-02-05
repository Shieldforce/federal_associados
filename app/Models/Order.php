<?php

namespace App\Models;

use App\Models\Item\Item;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    use Filterable;

    protected $fillable = [
        "plan_id",
    ];

    /**
     * Relations
     */
    public function plan()
    {
        return $this->hasMany(Plan::class, "id", "plan_id");
    }

    public function items()
    {
        return $this->hasMany(Item::class, "order_id", "id");
    }
}
