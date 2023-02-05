<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    use Filterable;

    protected $fillable = [
        "plan_id",
    ];

    public function plan()
    {
        return $this->hasMany(Plan::class, "id", "plan_id");
    }
}
