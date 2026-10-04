<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Auth\AuthServiceInterface;
use App\Services\Auth\AuthService;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    $this->app->bind(AuthServiceInterface::class, AuthService::class);
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
