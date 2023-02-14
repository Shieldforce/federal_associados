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
    ];

    /**
     * Relations
     */
    public function plan()
    {
        return $this->hasMany(Plan::class, "id", "plan_id");
    }
}
