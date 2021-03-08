<?php

namespace App\Http\Middleware;

use App\Events\ApiRequestHit;
use Closure;
use Illuminate\Http\Request;

class RequestHit
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
        ApiRequestHit::dispatch($request->user());

        return $next($request);
    }
}
