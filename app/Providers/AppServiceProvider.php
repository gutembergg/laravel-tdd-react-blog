<?php

namespace App\Providers;

use App\Contracts\Post\StorePostContract;
use App\Services\Post\StoreService;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(StorePostContract::class, StoreService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //JsonResource::withoutWrapping();
    }
}