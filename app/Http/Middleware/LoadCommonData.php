<?php

namespace App\Http\Middleware;

use Closure;

class LoadCommonData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        view()->share('forum_categories', \App\Categories::with('forums')->get());
        return $next($request);
    }
}
