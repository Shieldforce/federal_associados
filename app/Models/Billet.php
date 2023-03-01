<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

class Billet extends Model
{

    use Filterable;

    protected $fillable = [
        "our_number",
        "link",
        "bar_code",
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
