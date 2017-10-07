<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;
use Flymyshop\Core\EnablePlugins;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Relation::morphMap([
            'CheckMulti' => 'App\Http\Models\FeatureValueCheckMulti',
            'CheckSingle' => 'App\Http\Models\FeatureValueCheckSingle',
            'SelectNum' => 'App\Http\Models\FeatureValueSelectNum',
            'SelectText' => 'App\Http\Models\FeatureValueSelectText',
            'Product' => 'App\Http\Models\Product',
            'Feature' => 'App\Http\Models\Feature',
            'Filter' => 'App\Http\Models\Filter',
        ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
//        if (!Schema::hasTable('plugins')) {
//            new EnablePlugins();
//        }

        $this->app->bind(
            'ImagesModel',
            \App\Http\Models\Images::class
        );

        $this->app->bind(
            \App\Http\Controllers\PathManager\PathManagerInterface::class,
            \App\Http\Controllers\PathManager\PathManager::class
        );
    }
}