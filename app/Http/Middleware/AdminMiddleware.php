<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(
        Request $request,
        Closure $next
    ): Response {

        /*
        |--------------------------------------------------------------------------
        | CHECK AUTHENTICATION
        |--------------------------------------------------------------------------
        */

        if (!auth()->check()) {
            return redirect()->route('login');
        }

        /*
        |--------------------------------------------------------------------------
        | CHECK ADMIN PERMISSION
        |--------------------------------------------------------------------------
        */

        if (!auth()->user()->is_admin) {
            abort(403, 'Unauthorized. Admin access only.');
        }

        /*
        |--------------------------------------------------------------------------
        | ALLOW ADMIN ACCESS
        |--------------------------------------------------------------------------
        */

        return $next($request);
    }
}
