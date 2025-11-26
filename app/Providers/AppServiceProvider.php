<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    
    public function boot(): void
    {
    // Permitir autenticación con numero_control en lugar de email
    Auth::provider('custom', function ($app, array $config) {
        return new \Illuminate\Auth\EloquentUserProvider(
            $app['hash'],
            $config['model']
        );
    });
    }
}
