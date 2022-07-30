<?php

namespace App\Http\Middleware;

use Closure;

class IsAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,... $roles)
    {
        foreach ($roles as $role) {
            if (auth()->user()->role == $role) {
                return $next($request);
            }
            abort(404);
        }

        return $next($request);
    }
}
