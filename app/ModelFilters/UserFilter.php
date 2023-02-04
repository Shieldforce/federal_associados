<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class UserFilter extends ModelFilter
{
    public $relations = [];


    public function name($name) {
        return $this->where('name', 'like', "%$name%");
    }
}
