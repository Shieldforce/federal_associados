<?php

namespace App\Models;

use App\Observers\RolesObserver;
use App\Scopes\RolesScope;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    protected $fillable = [
        'name',
        'description',
    ];

    public function users()
    {
        return $this->belongsToMany(
            User::class,
            "roles_users",
            "role_id",
            "user_id"
        )->withoutGlobalScopes();
    }

    public function permissions()
    {
        return $this->belongsToMany(
            Permission::class,
            "roles_permissions",
            "role_id",
            "permission_id"
        )->withPivot(["id", "role_id", "permission_id"])
            ->withoutGlobalScopes();
    }
}
