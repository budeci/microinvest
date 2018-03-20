<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Session\Store;


class AuthStandartSoap
{

    public function handle($request, Closure $next)
    {
        if (!session()->has('auth')) {
        	if($request->ajax())
        		return response(array('redirect'=>route('get_login')));
            
            return redirect()->route('get_login');
        } else if(session()->get('auth.applicationVariant') != '1') {
            abort('404');
        }
        return $next($request);
    }
}
