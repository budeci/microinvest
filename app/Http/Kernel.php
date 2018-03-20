<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfTokenForRoutes::class,
        ],

        'api' => [
            'throttle:60,1',
            'bindings',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth'                  => \App\Http\Middleware\Authenticate::class,
        'auth.basic'            => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'can'                   => \Illuminate\Foundation\Http\Middleware\Authorize::class,
        'guest'                 => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle'              => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'auth_soap_standart'    => \App\Http\Middleware\AuthStandartSoap::class,
        'auth_soap_business'    => \App\Http\Middleware\AuthBusinessSoap::class,
        'auth_soap_credit_auto' => \App\Http\Middleware\AuthCreditAutoSoap::class,
        'accept-ajax'           => \App\Http\Middleware\AcceptsAjaxOnly::class,
        'create_app'            => \App\Http\Middleware\CreateAplication::class,
    ];
}
