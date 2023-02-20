<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class PlanFilter extends ModelFilter
{
    public $relations = [];

    public function id($id) {
        return $this->where('id', $id);
    }
    public function type($search) {
        return $this->where('type', 'like', "%$search%");
    }

    public function name($search) {
        return $this->where('name', 'like', "%$search%");
    }

    public function description($search) {
        return $this->where('description', 'like', "%$search%");
    }

    public function percentage($search) {
        return $this->where('percentage', 'like', "%$search%");
    }

    public function value($search) {
        return $this->where('value', 'like', "%$search%");
    }

    public function allowed($search) {
        return $this->where('allowed', 'like', "%$search%");
    }

    public function operator($search) {
        return $this->where('operator', 'like', "%$search%");
    }
}
