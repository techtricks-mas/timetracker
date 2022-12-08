<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class RoleChecker
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $adminRole, $employee, $candidate)
    {
        $role = Auth::user()->role;
        if ($adminRole === $role) {
            return $next($request);
        } else if ($employee === $role) {
            return $next($request);
        } else if ($candidate === $role) {
            return $next($request);
        }

        abort(403);
    }
}
