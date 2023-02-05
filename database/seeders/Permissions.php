<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Route;

class Permissions extends Seeder
{
    public function run()
    {

            $routesAll = Route::getRoutes()->getRoutes();
            foreach ($routesAll as $key => $route)
            {
                if(array_search('auth:sanctum', $route->middleware()) === false) {
                    unset($routesAll[$key]);
                }
            }
            foreach ($routesAll as $routeAccept) {
                Permission::updateOrCreate(["name" => $routeAccept->getName()], [
                    "name" => $routeAccept->getName(),
                    "description" => $routeAccept->wheres["description"] ?? "Não há descrição",
                    "group" => $routeAccept->wheres["group"] ?? "Genérico"
                ]);

            }
            $actions = array_column($routesAll, "action");
            $names = array_column($actions, "as");
            Permission::whereNotIn("name", $names)->delete();

            Role::where('name', 'SA')->first()?->permissions()->sync(Permission::pluck('id'));

    }
}
