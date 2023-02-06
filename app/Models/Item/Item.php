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
    public function antena()
    {
        return $this->morphOne(Antena::class, 'itemable');
    }

    public function veiculo()
    {
        return $this->morphOne(Veiculo::class, 'itemable');
    }

    public function rastreado()
    {
        return $this->morphOne(Rastreador::class, 'itemable');
    }

    public function chip()
    {
        return $this->morphOne(Chip::class, 'itemable');
    }

    public function order()
    {
        return $this->hasMany(Order::class, "id", "order_id");
    }
}
