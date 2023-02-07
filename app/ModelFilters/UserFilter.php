<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class UserFilter extends ModelFilter
{
    public $relations = [];

    public function id($id)
    {
        return $this->where('id', $id);
    }

    public function name($name)
    {
        return $this->where('name', 'like', "%$name%");
    }

    public function perRole($nameRole)
    {
        // $nameRole = ucfirst($nameRole);

        return $this->whereHas("roles", function ($roles) use ($nameRole) {
            $roles->where("name", "like", "%$nameRole%");
        });
    }

}
