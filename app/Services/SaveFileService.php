<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class SaveFileService
{

    protected $file;
    public static function run($file, $path)
    {
        return  Storage::disk('public')->put($path, $file);
    }
}
