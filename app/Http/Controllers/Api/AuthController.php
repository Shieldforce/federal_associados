<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Middleware\ACL;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AuthLoginRequest;
use App\Http\Requests\AuthRegisterRequest;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    public function login(AuthLoginRequest $validate)
    {
        $user  = User::where("email", $validate->email)->first();
        if (! $user || ! Hash::check($validate->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Credênciais incorretas!.'],
            ]);
        }
        $user->tokens()->where("name", $validate->client)->delete();
        $resourceUser = new UserResource($user);
        $permissions = $resourceUser->toArray($validate)["permissions"] ?? [];
        $token = $user->createToken($validate->client);
        return [
            'type_token'   => 'Bearer',
            'access_token' => $token->plainTextToken,
            'expires_at'   => $token->expires_at ?? null
        ];
    }

    public function verifyToken(Request $request)
    {
        return new UserResource($request->user());
    }

    public function logout(Request $request)
    {
        return response()->json([
            'logout' => $request->user()->currentAccessToken()->delete()
        ]);
    }

    public function register(AuthRegisterRequest $request)
    {
        $data = $request->validated();
        $data['father_id'] = User::where('uuid', $data['father_uuid'])->first()->id;

        $user = User::create($data);
        $user->address()->create($data['address']);

        
    }
 
}
