<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{

    use Filterable;

    protected $fillable = [
        "code",
        "date",
    ];

    /**
     * Relations
     */
    public function plan()
    {
        return $this->hasMany(Plan::class, "id", "plan_id");
    }
}
