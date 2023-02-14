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
    ];

    /**
     * Relations
     */
    public function plan()
    {
        return $this->hasMany(Plan::class, "id", "plan_id");
    }
}
