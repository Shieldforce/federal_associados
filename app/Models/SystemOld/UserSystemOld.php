<?php

namespace App\Models\SystemOld;

use EloquentFilter\Filterable;

class UserSystemOld extends SystemOldModelAbstract
{

    use Filterable;

    protected $table = "user";

    protected $primaryKey = "user_id";

    protected $fillable = [

    ];

    /**
     * Relations
     */

    public function pedidos()
    {
        return $this->hasMany(OrderSystemOld::class, "pedido_id_user", "user_id");
    }
}
