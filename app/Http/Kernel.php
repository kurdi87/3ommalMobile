<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
    
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \App\Http\Middleware\EncryptCookies::class,
        
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,

            \App\Http\Middleware\Language::class,
      //  'Barryvdh\Cors\Middleware\HandleCors'
        '\Barryvdh\Cors\HandleCors'

    ];

    protected $middlewareGroups = [
        'web' => [
            \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            'throttle:60,1',
            'bindings',
        ],
    ];



    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'admin' => \App\Http\Middleware\AdminAuthenticate::class,
        'admin.guest' => \App\Http\Middleware\AdminGuest::class,
        'site' => \App\Http\Middleware\Site::class,
        'jwt.auth' => \Tymon\JWTAuth\Middleware\GetUserFromToken::class,
        'jwt.refresh' => \Tymon\JWTAuth\Middleware\RefreshToken::class
    ];
}