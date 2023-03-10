<?php

namespace App\Models;

use Illuminate\Support\Str;
use EloquentFilter\Filterable;
use Laravel\Sanctum\HasApiTokens;
use App\Observers\SaveFileObserver;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Filterable;

    protected $fillable = [
        'name',
        'email',
        'cpf',
        'password',
        'file_link',
        'uuid',
        'father_id'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function (User $model) {
            $model->uuid = (string) Str::uuid();
        });
        self::observe(new SaveFileObserver());
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function address()
    {
        return $this->morphOne(Address::class, 'addressable');
    }

    public function roles()
    {
        return $this->belongsToMany(
            Role::class ,
            "roles_users",
            "user_id",
            "role_id"
        )->withPivot(["id", "user_id", "role_id"])
            ->withoutGlobalScopes();
    }

    //Functions
    public function hasPermission($permission)
    {
        return $this->hasAnyRoles($permission->roles);
    }

    public function hasRoles($roles)
    {
        if( is_array($roles) || is_object($roles) ) {
            return (bool) !$this->roles->whereIn('name', $roles)->count() == 0;
        }
        return (bool) !$this->roles->where('name', $roles)->count() == 0;
    }

    public function allPermissions()
    {
        return Permission::whereHas('roles', function ($query) {
            $query->whereIn('name', $this->roles->pluck('name'));
        })?->pluck('name')->toArray();
    }

     protected function password(): Attribute
     {
         return Attribute::make(
             set: fn ($value) => bcrypt($value),
             get: fn ($value) => $value,
         );
     }
}
