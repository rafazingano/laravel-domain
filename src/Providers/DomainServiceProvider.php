<?php

namespace ConfrariaWeb\Domain\Providers;

use Illuminate\Support\ServiceProvider;
use ConfrariaWeb\Domain\Contracts\DomainContract;
use ConfrariaWeb\Domain\Repositories\DomainRepository;
use ConfrariaWeb\Domain\Services\DomainService;

class DomainServiceProvider extends ServiceProvider
{
    
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../Routes/web.php');
        $this->loadMigrationsFrom(__DIR__ . '/../../databases/Migrations');
        $this->loadViewsFrom(__DIR__.'/../Views', 'domain');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
       $this->app->bind(DomainContract::class, DomainRepository::class);
        $this->app->singleton('DomainService', function ($app) {
            return new DomainService($app->make(DomainContract::class));
        });
    }

}
