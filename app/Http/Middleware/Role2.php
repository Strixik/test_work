<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class Role2
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $role = Auth::user()->getRole();
        if (User::ROLE_2 == $role) {
            return $next($request);
        }

        return response()->json(['message' => 'Method1 is only available for Role1'], 403, ['Content-type'=>'text/html', 'charset' => 'utf-8']);
    }
}
