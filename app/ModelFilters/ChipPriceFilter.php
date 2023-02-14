<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class ChipPriceFilter extends ModelFilter
{
    public $relations = [];

    public function name($search) {
        return $this->where('name', 'like', "%$search%");
    }

    public function GB($search) {
        return $this->where('GB', 'like', "%$search%");
    }

    public function allow_voice($search) {
        return $this->where('allow_voice', 'like', "%$search%");
    }

    public function price($search) {
        return $this->where('price', 'like', "%$search%");
    }

    public function operator_id($search) {
        return $this->where('operator_id', 'like', "%$search%");
    }
}
