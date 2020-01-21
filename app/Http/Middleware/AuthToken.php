<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class AuthToken
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token = $request->get('token');
        if (!User::tokenExists($token)) {
            return response()->json(['message' => 'Unauthorized'], 401, ['Content-type'=>'text/html', 'charset' => 'utf-8']);
        }
        Auth::setUser(User::getUserFromToken($token));

        return $next($request);

    }
}
