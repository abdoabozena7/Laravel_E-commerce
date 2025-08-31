<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * EnsureSeller middleware restricts routes to users with a seller role.
 *
 * If the authenticated user does not have the role 'seller', the
 * middleware will abort with a 403 error.
 */
class EnsureSeller
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        if ($user && $user->role === 'seller') {
            return $next($request);
        }

        abort(403, 'Unauthorized.');
    }
}