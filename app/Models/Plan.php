<?php

namespace App\Models;

use App\Observers\SaveFileObserver;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{

    use Filterable;

    protected $fillable = [
        "name",
        "description",
        "protect_plan",
        "tracking",
        "file_link",
    ];

    protected $casts = [
        "protect_plan" => "boolean",
        "tracking" => "boolean",
    ];

    protected static function boot()
    {
        parent::boot();
        self::observe(new SaveFileObserver());
    }

    /**
     * Relations
     */
    public function orders()
    {
        return $this->hasMany(Order::class, "plan_id", "id");
    }

    public function alloweds()
    {
        return $this->hasMany(Allowed::class, "plan_id", "id");
    }

}
