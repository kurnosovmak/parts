<?php

namespace Kurnosovmak\Parts\Providers;

use Illuminate\Support\ServiceProvider;
use Kurnosovmak\Parts\Parts\Domain\Repository\PartRepository;
use Kurnosovmak\Parts\Parts\Infra\Adapters\PartAdapter;
use Kurnosovmak\Parts\Parts\Infra\Repository\EloquentPartRepository;

class PartServiceProvider extends ServiceProvider
{

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

            $this->publishes([
                __DIR__ . '/../../config/parts.php' => config_path('parts.php'),
            ]);
        }

        $this->app->singleton(PartRepository::class, EloquentPartRepository::class);
        $this->app->bind('part', PartAdapter::class);

        $this->loadRoutesFrom(__DIR__ . '/../../routes/api.php');
    }
}