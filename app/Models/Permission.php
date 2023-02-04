<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'name',
        'description'
    ];

    public function roles()
    {
        return $this->belongsToMany(
            Role::class,
            "roles_permissions",
            "permission_id",
            "role_id"
        )->withPivot(["id", "role_id", "permission_id"])
            ->withoutGlobalScopes();
    }

}
