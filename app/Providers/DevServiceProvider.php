<?php

namespace App\Providers;

//use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class DevServiceProvider extends ServiceProvider
{

    protected $namespace = 'App\Http\Controllers';

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    public function map()
    {
        if($this->app->environment() == 'local') {
            $this->mapDevRoutes();
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment('local', 'testing')) {

            $this->app->register(\Laravel\Dusk\DuskServiceProvider::class);
            $this->app->bind('TestDataClass', function () {
                return new \App\Http\Controllers\TestDataManager\TestDataClass();
            });

        }
        if($this->app->environment() == 'local') {
            $this->app->register(\Laravel\Tinker\TinkerServiceProvider::class);
            $this->app->register(\Laracademy\Generators\GeneratorsServiceProvider::class);
            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
            $this->app->register(\Mpociot\LaravelTestFactoryHelper\TestFactoryHelperServiceProvider::class);
            $this->app->register(\GrahamCampbell\Exceptions\ExceptionsServiceProvider::class);

            /*
             * Cross-origin resource
             */
            $this->app->register(\Barryvdh\Cors\ServiceProvider::class);
        }
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    private function mapDevRoutes()
    {
        Route::group([
            'middleware' => 'web',
            'namespace' => $this->namespace,
        ], function ($router) {
            require base_path('routes/dev.php');
        });
    }
}
