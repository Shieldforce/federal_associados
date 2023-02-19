<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

class Allowed extends Model
{

    use Filterable;

    protected $fillable = [
        "plan_id",
        "type",
        "value",
        "rule",
        "required",
    ];

    protected $casts = [
        "required" => "boolean"
    ];
    /**
     * Relations
     */
    public function plan()
    {
        return $this->hasMany(Plan::class, "id", "plan_id");
    }
}
