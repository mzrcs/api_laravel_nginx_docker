<?php

namespace App\Http\Middleware;

use App\Models\RequestResponseLogs;
use Closure;
use Illuminate\Http\Request;

class RequestResponseLogger
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
        RequestResponseLogs::$requestStartTime = microtime(false);
        return $next($request);
    }
}
