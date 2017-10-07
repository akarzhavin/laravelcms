<?php
/**
 * @author Alexander Korzhavin <san_rrz@mail.ru>
 * Date: 17.08.2017
 * Time: 14:17
 */
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
            \App\Http\Middleware\VerifyCsrfToken::class,
//            \App\Http\Middleware\CheckUserRole::class,
        ],

        'auth' => [
//            \App\Http\Middleware\EncryptCookies::class,
            \App\Http\Middleware\Authenticate::class,
        ],

        'api' => [
            \App\Http\Middleware\EncryptCookies::class,
//            \Barryvdh\Cors\HandleCors::class,
            'throttle:60,1',
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
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'can'        => \Illuminate\Foundation\Http\Middleware\Authorize::class,
        'guest'      => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle'   => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'admin'      => \App\Http\Middleware\CheckUserRole::class,
        'checkout'   => \App\Http\Middleware\VerifyCheckOut::class,
    ];
}
