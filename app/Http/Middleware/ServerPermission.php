<?php

namespace App\Http\Middleware;

use App\Models\Server\Company;
use Closure;
use Illuminate\Http\Request;

class ServerPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->user()->userable_type === Company::class) {
            abort(403);
        }
        return $next($request);
    }
}
