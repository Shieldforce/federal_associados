<?php

namespace App\Http\Controllers\Api;

use App\Models\Role;
use App\Models\Permission;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoleCreateRequest;
use App\Http\Resources\RoleListResource;

class RoleController extends Controller
{

    public function show(Role $role) {
        return new RoleListResource($role);
    }

    public function create(RoleCreateRequest $request)
    {
        $data = $request->validated();
        $create = Role::updateOrCreate([ "name"=> $request->name ], $data );
        $create->permissions()->sync(Permission::whereIn("name", $request->permissions_names)->pluck("id"), true);
        return new RoleListResource($create);
    }

    public function update(RoleCreateRequest $request, Role $role)
    {
        $data = $request->validated();
        $role->update( $data );
        if(isset($request->permissions_names)) {
            $role->permissions()->sync(Permission::whereIn("name", $request->permissions_names)->pluck("id"), true);
        }
        return new RoleListResource($role);
    }

    public function index()
    {
        return RoleListResource::collection(
            Role::orderBy('created_at', 'desc')->paginate(10)
        );
    }

    public function listRolesPublic()
    {
        return RoleListResource::collection(Role::orderBy('created_at', 'desc')->paginate(10));
    }

    public function delete(Role $role)
    {
        return $role->delete();
    }
}
