<?php

namespace Bkv1409\SystemConfig;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;


class SystemConfigServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
         $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'system-config');
         $this->loadViewsFrom(__DIR__.'/../resources/views', 'system-config');
         $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
//         $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
         $this->registerRoutes();

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/system-config.php', 'system-config');

        // Register the service the package provides.
        $this->app->singleton('system-config', function ($app) {
            return new SystemConfig;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['system-config'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/system-config.php' => config_path('system-config.php'),
        ], 'system-config.config');

        // Publishing the views.
        $this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/bkv1409'),
        ], 'system-config.views');

        // Publishing assets.
        $this->publishes([
            __DIR__.'/../resources/assets' => public_path('system-config'),
        ], 'system-config.assets');

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/bkv1409'),
        ], 'system-config.views');*/

        // Registering package commands.
        // $this->commands([]);
    }

    protected function registerRoutes()
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        });
    }

    protected function routeConfiguration()
    {
        return [
            'prefix' => config('system-config.prefix'),
            'middleware' => config('system-config.middleware'),
        ];
    }
}
