<?php 
namespace App\Http\Middleware;
use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfTokenForRoutes extends BaseVerifier
{

    protected $excludeRoutes = [
        'getPaymentSchedule',
        'upload_file',
        'remove_file',
        'getClientData',
        'get_app',
        'get_apps',
        'sendFormEmail',
        'send_form_email',
        'remove_form_file'
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        foreach ($this->excludeRoutes as $route)
            if($request->route()->getName() == $route)
                return $next($request);

        return parent::handle($request, $next);
    }
}