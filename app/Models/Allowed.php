<?php

namespace App\Models;

use App\Enums\AllowedEnum;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Casts\Attribute;
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

    /**
     * Mutators
     */

    protected function type(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => AllowedEnum::getValueByDescription($value),
            get: fn ($value) => AllowedEnum::from($value)->name,
        );
    }
}
