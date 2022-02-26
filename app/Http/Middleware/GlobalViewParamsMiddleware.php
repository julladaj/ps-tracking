<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class GlobalViewParamsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            $isSuperAdmin = optional(auth())->user()->hasRole('super-admin');
            $userRoleNames = optional(auth())->user()->getRoleNames()->all();

            \View::share('isSuperAdmin', $isSuperAdmin);
            \View::share('userRoleNames', $userRoleNames);
        }

        \View::share('request', $request);

        return $next($request);
    }
}
