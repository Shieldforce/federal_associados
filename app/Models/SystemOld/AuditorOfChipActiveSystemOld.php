<?php

namespace App\Models\SystemOld;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

class AuditorOfChipActiveSystemOld extends Model
{

    use Filterable;

    protected $table = "auditor_of_chips_actives";

    protected $fillable = [
        "order_id",
        "amount_billings",
        "user_name",
        "chip_number",
        "line_number",
    ];

    /**
     * Relations
     */
}
