<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{

    use Filterable;

    protected $fillable = [
        "type",
        "value",
        "date",
        "order_id",
    ];

    /**
     * Relations
     */
    public function order()
    {
        return $this->hasOne(Order::class, "id", "order_id");
    }
}
