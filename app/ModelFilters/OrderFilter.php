<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class OrderFilter extends ModelFilter
{
    public $relations = [];


    public function id($id) {
        return $this->where('id', $id);
    }
}
