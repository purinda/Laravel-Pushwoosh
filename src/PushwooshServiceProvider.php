<?php

/*
 * This file is part of Laravel Pushwoosh.
 *
 * (c) HOY Multimedia AB <info@hoy.se>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hoy\Pushwoosh;

use Gomoob\Pushwoosh\Client\Pushwoosh;
use Illuminate\Contracts\Container\Container;
use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application as LumenApplication;

/**
 * This is the Pushwoosh service provider class.
 *
 * @author Vincent Klaiber <vincent@hoy.se>
 */
class PushwooshServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->setupConfig();
    }

    /**
     * Setup the config.
     *
     * @return void
     */
    protected function setupConfig()
    {
        $source = realpath(__DIR__.'/../config/pushwoosh.php');

        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->publishes([$source => config_path('pushwoosh.php')]);
        } elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('pushwoosh');
        }

        $this->mergeConfigFrom($source, 'pushwoosh');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerFactory();
        $this->registerManager();
        $this->registerBindings();
    }

    /**
     * Register the factory class.
     *
     * @return void
     */
    protected function registerFactory()
    {
        $this->app->singleton('pushwoosh.factory', function () {
            return new PushwooshFactory();
        });

        $this->app->alias('pushwoosh.factory', PushwooshFactory::class);
    }

    /**
     * Register the manager class.
     *
     * @return void
     */
    protected function registerManager()
    {
        $this->app->singleton('pushwoosh', function (Container $app) {
            $config = $app['config'];
            $factory = $app['pushwoosh.factory'];

            return new PushwooshManager($config, $factory);
        });

        $this->app->alias('pushwoosh', PushwooshManager::class);
    }

    /**
     * Register the bindings.
     *
     * @return void
     */
    protected function registerBindings()
    {
        $this->app->bind('pushwoosh.connection', function (Container $app) {
            $manager = $app['pushwoosh'];

            return $manager->connection();
        });

        $this->app->alias('pushwoosh.connection', Pushwoosh::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides()
    {
        return [
            'pushwoosh',
            'pushwoosh.factory',
            'pushwoosh.connection',
        ];
    }
}
