<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use App\Models\Plan;
use App\Models\User;
use App\Http\Middleware\ACL;
use App\Services\Order\CalcPriceDynamicService;
use App\Services\Order\CalcPriceFixedService;
use App\Services\Order\VerifyIsPriceFixedOrDynamicService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $user = User::where("email", $validate->email)->first();
        if (!$user || !Hash::check($validate->password, $user->password)) {
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

        DB::transaction(function () use ($data) {

            $fatherId = isset($data['father_uuid'])
                ? User::where('uuid', $data['father_uuid'])->first()->id
                : User::where('id', 1)->first()->id;
            $data['father_id'] = $fatherId;

            $user = User::create($data);

            $user->address()->create($data['address']);

            $price = VerifyIsPriceFixedOrDynamicService::run($data);

            $createOrder = Order::create([
                "plan_id"     => $data["plan_id"],
                "client_id"   => $data["client_id"],
                "shipping_id" => $data["shipping_id"] ?? null,
                "value"       => $price ?? null,
                "status"      => $data["status"] ?? null,
                "dueDay"      => "10" ?? null,
                "reference"   => now()->format("m/Y"),
                "type"        => "default",
                "obs"         => $data["obs"] ?? null,
            ]);

            #TODO: items de orders tem que receber os refs -> ref_chip_id e ref_vehicle_id

        });
    }

}
