<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckMaintenanceMode
{
    public function handle(Request $request, Closure $next)
    {
        if (env('APP_MAINTENANCE', false) && !$request->is('maintenance')) {
            return redirect('/maintenance');
        }

        return $next($request);
    }
}
