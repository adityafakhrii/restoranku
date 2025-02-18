<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, int $roleID): Response
    {
        if (Auth::guest()) {
            return redirect()->route('login');
        }

        if (Auth::user()->role_id != $roleID) {
            abort(403);
        }

        return $next($request);
    }
}
