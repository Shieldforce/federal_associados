<?php

namespace App\Models;

use App\Observers\SaveFileObserver;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{

    use Filterable;

    protected $fillable = [
        "type",
        "name",
        "description",
        "percentage",
        "value",
        "allowed",
        "operator",
        "file_link",
    ];

    protected static function boot()
    {
        parent::boot();
        self::observe(new SaveFileObserver());
    }

    public function orders()
    {
        return $this->hasMany(Order::class, "plan_id", "id");
    }

    protected function allowed(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => json_encode($value),
            get: fn ($value) => json_decode($value, true),
        );
    }
}
