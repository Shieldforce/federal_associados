<?php

namespace App\Models\SystemOld;

use EloquentFilter\Filterable;

class LinhaSystemOld extends SystemOldModelAbstract
{

    use Filterable;

    protected $table = "linha";

    protected $primaryKey = "id";

    protected $fillable = [

    ];

    /**
     * Relations
     */

    public function chip()
    {
        return $this->hasOne(ChipSystemOld::class, "chip_num", "id");
    }
}
