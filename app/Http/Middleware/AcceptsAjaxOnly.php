<?php

namespace App\Http\Middleware;
use Illuminate\Http\Request;
use App\Http\Requests;
class AcceptsAjaxOnly
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle(Request $request, \Closure $next)
    {
        if($request->ajax())
            return $next($request);

        abort('404');
    }
}