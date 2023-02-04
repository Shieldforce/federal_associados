<?php

namespace App\Http\Middleware;

use App\Models\Permission;
use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class ACL
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        $routeName = $request->route()->getName();
        $sa = $user->roles()->where("name", "SA")->first();
        $hasPermission = $user->roles()
        ->whereHas('permissions', function ($query) use ($routeName) {
            $query->where('name', $routeName);
        })->first();
        if( !isset($sa->id) && !$hasPermission ) {
            return response()->json(["message"=> "Unauthorized"], 403);
        }
        return $next($request);
    }

}
