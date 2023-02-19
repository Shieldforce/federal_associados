<?php

namespace App\Models\SystemOld;

use Illuminate\Database\Eloquent\Model;

abstract class SystemOldModelAbstract extends Model
{
    protected $connection = "system_old";
}
