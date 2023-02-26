<?php

namespace App\Models;

use App\Enums\StatusEnum;
use App\Models\Item\Item;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    use Filterable;

    protected $fillable = [
        "plan_id",
        "client_id",
        "shipping_id",
        "value",
        "status",
        "dueDay",
        "reference",
        "type",
        "activationDate",
        "cancellationDate",
        "adhesion_percentage",
        "adhesion_price",
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

    public function shipping()
    {
        return $this->hasMany(Shipping::class, "id", "shipping_id");
    }

    public function items()
    {
        return $this->hasMany(Item::class, "order_id", "id");
    }

    /**
     * Mutators
     */

    protected function status(): Attribute
    {
        return Attribute::make(
            set: fn($value) => $value,
            get: fn($value) => StatusEnum::getValueByDescription($value),
        );
    }
}
