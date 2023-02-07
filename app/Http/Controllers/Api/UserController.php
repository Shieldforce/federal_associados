<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\SaveFileRequest;
use App\Http\Resources\UserListResource;
use App\Http\Resources\UserResource;
use App\Models\Role;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Users\UserCreateRequest;
use App\Http\Requests\Users\UserUpdateRequest;

class UserController extends Controller
{
    public function index(Request $request)
    {
        return UserListResource::collection(
            User::filter($request->all())->paginate(10)
        );
    }

    public function store(UserCreateRequest $request)
    {

        $data = $request->validated();
        $user = User::create($data);
        if (Auth::user()->hasRoles('SA')) {
            $user->roles()->sync(Role::whereIn('name', $data['roles'] ?? [])->pluck('id'));
        } else {
            $user->roles()->sync(Role::where('name', 'Cliente')->pluck('id'));
        }

        return new UserListResource($user);
    }

    public function saveFile(SaveFileRequest $request, User $user)
    {
        $user->update($request->safe()->only(["file_link"]));
        return new UserResource($user);
    }

    public function show(User $user)
    {
        return new UserListResource($user);
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $data = $request->validated();
        $user->update($data);

        if (Auth::user()->hasRoles('SA')) {
            $user->roles()->sync(Role::whereIn('name', $data['roles'] ?? [])->pluck('id'));
        } else {
            $user->roles()->sync(Role::where('name', 'Cliente')->pluck('id'));
        }

        return new UserListResource($user);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(200);
    }
}
