<?php

namespace ConfrariaWeb\Domain\Providers;

use ConfrariaWeb\Domain\Contracts\DomainDnsContract;
use ConfrariaWeb\Domain\Models\Domain;
use ConfrariaWeb\Domain\Models\DomainDns;
use ConfrariaWeb\Domain\Observers\DomainDnsObserver;
use ConfrariaWeb\Domain\Observers\DomainObserver;
use ConfrariaWeb\Domain\Repositories\DomainDnsRepository;
use ConfrariaWeb\Domain\Services\DomainDnsService;
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
        //$this->registerSeedsFrom(__DIR__.'/../../databases/Seeds');
        $this->publishes([__DIR__ . '/../../config/cw_domain.php' => config_path('cw_domain.php')], 'config');

        Domain::observe(DomainObserver::class);
        DomainDns::observe(DomainDnsObserver::class);
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

        $this->app->bind(DomainDnsContract::class, DomainDnsRepository::class);
        $this->app->singleton('DomainDnsService', function ($app) {
            return new DomainDnsService($app->make(DomainDnsContract::class));
        });
    }

}
