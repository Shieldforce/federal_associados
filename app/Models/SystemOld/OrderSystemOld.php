<?php

namespace App\Models\SystemOld;

use EloquentFilter\Filterable;

class OrderSystemOld extends SystemOldModelAbstract
{

    use Filterable;

    protected $table = "pedido";

    protected $primaryKey = "pedido_id";

    protected $fillable = [

    ];

    /**
     * Relations
     */

    public function user()
    {
        return $this->hasOne(UserSystemOld::class, "user_id", "pedido_id_user");
    }

    public function chips()
    {
        return $this->belongsToMany(
            OrderSystemOld::class, "itens_pedido_chip",
            "itens_pedido_chip_id_pedido",
            "itens_pedido_chip_id_chip",
        );
    }
}
