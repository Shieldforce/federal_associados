<?php

namespace App\Models\SystemOld;

use EloquentFilter\Filterable;

class ChipSystemOld extends SystemOldModelAbstract
{

    use Filterable;

    protected $table = "chip";

    protected $primaryKey = "chip_id";

    protected $fillable = [

    ];

    /**
     * Relations
     */

    public function pedidos()
    {
        return $this->belongsToMany(
            OrderSystemOld::class, "itens_pedido_chip",
            "itens_pedido_chip_id_chip",
            "itens_pedido_chip_id_pedido",
        );
    }

    public function linha()
    {
        return $this->hasOne(LinhaSystemOld::class, "id", "chip_num");
    }
}
