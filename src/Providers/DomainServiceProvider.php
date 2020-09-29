<?php

namespace ConfrariaWeb\Domain\Providers;

use Illuminate\Support\ServiceProvider;

use ConfrariaWeb\Domain\Contracts\DomainContract;
use ConfrariaWeb\Domain\Repositories\DomainEloquent;
use Confrariaeb\Domain\Services\DomainService;

class DomainServiceProvider extends ServiceProvider
{
    
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    //protected $defer = true;
    
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../Routes/web.php');
        $this->loadMigrationsFrom(__DIR__ . '/../../Databases/Migrations');
        $this->loadTranslationsFrom(__DIR__.'/../Translations', 'domain');
        $this->loadViewsFrom(__DIR__.'/../Views', 'domain');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
       $this->app->bind(DomainContract::class, DomainEloquent::class);
        $this->app->singleton('DomainService', function ($app) {
            return new DomainService($app->make(DomainContract::class));
        });
    }
    
    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    /*
    public function provides()
    {
        return [
            'DomainService'
        ];
    }
    */
}
