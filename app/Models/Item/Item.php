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
        "type",
        "cancel_date",
        "status",
        "order_id",
    ];

    /**
     * Relations
     */
    public function order()
    {
        return $this->hasMany(Order::class, "id", "order_id");
    }

    public function antenna()
    {
        return $this->morphMany(Antenna::class, 'itemable');
    }

    public function vehicle()
    {
        return $this->morphMany(Vehicle::class, 'itemable');
    }

    public function tracker()
    {
        return $this->morphMany(Tracker::class, 'itemable');
    }

    public function chips()
    {
        return $this->morphMany(Chip::class, 'itemable');
    }


}
