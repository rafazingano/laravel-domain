<?php

namespace ConfrariaWeb\Domain\Providers;

use ConfrariaWeb\Domain\Models\Domain;
use ConfrariaWeb\Domain\Observers\DomainObserver;
use ConfrariaWeb\Vendor\Traits\ProviderTrait;
use Illuminate\Support\ServiceProvider;
use ConfrariaWeb\Domain\Contracts\DomainContract;
use ConfrariaWeb\Domain\Repositories\DomainRepository;
use ConfrariaWeb\Domain\Services\DomainService;

class DomainServiceProvider extends ServiceProvider
{
    use ProviderTrait;
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
        $this->registerSeedsFrom(__DIR__.'/../../databases/Seeds');

        Domain::observe(DomainObserver::class);
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
