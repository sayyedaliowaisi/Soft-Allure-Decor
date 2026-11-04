<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    public function handle(
        Request $request,
        Closure $next
    ): Response {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if (auth()->user()->is_admin !== true) {
            abort(403, 'Unauthorized. Admin access only.');
        }

        return $next($request);
    }
}
