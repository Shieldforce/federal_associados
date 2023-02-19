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
        "client_id",
        "value",
        "status",
        "dueDate",
        "reference",
        "type",
        "description",
        "activationDate",
        "cancellationDate",
        "obs",
    ];

    /**
     * Relations
     */
    public function plan()
    {
        return $this->hasOne(Plan::class, "id", "plan_id");
    }

    public function client()
    {
        return $this->hasOne(User::class, "id", "client_id");
    }

    public function items()
    {
        return $this->hasMany(Item::class, "order_id", "id");
    }
}
