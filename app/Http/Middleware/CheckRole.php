<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param String $roleName
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next, string $roleName)
    {

        // check if user role is not admin show 404 page
        if ($roleName == 'Admin' && $request->user()->role->name != 'Admin') {
            return abort(403);
        } // check if user role is not Alumni show 404 page
        else if ($roleName == 'Alumni' && $request->user()->role->name != 'Alumni') {
            return abort(403);
        } // check if user role is not Student show 404 page
        else if ($roleName == 'Student' && $request->user()->role->name != 'Student') {
            return abort(403);
        }

        return $next($request);
    }
}
