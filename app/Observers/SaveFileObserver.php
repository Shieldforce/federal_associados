<?php

namespace App\Observers;

use App\Services\SaveFileService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class SaveFileObserver
{
    public function saving(Model $model)
    {

        if(
            request()->route() &&
            strpos(request()->route()->getName(), ".saveFile")  !== false &&
            request()->hasFile("file_link")
        ) {
            $class   = $model->getTable();
            $path    = "files/{$class}/{$model->id}";
            $dir     = base_path()."/storage/app/public/{$path}";

            if(is_dir($dir)) {
                foreach (File::allFiles($dir) as $route_file) {
                    unlink($route_file->getPathname());
                }
            }

            $storage = SaveFileService::run(request()->file("file_link"), $path);
            $model->file_link = $storage;
        }
    }
}
