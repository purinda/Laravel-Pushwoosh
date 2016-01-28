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
use Illuminate\Contracts\Container\Container as Application;
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
        $this->registerFactory($this->app);
        $this->registerManager($this->app);
        $this->registerBindings($this->app);
    }

    /**
     * Register the factory class.
     *
     * @param \Illuminate\Contracts\Container\Container $app
     *
     * @return void
     */
    protected function registerFactory(Application $app)
    {
        $app->singleton('pushwoosh.factory', function () {
            return new PushwooshFactory();
        });

        $app->alias('pushwoosh.factory', PushwooshFactory::class);
    }

    /**
     * Register the manager class.
     *
     * @param \Illuminate\Contracts\Container\Container $app
     *
     * @return void
     */
    protected function registerManager(Application $app)
    {
        $app->singleton('pushwoosh', function ($app) {
            $config = $app['config'];
            $factory = $app['pushwoosh.factory'];

            return new PushwooshManager($config, $factory);
        });

        $app->alias('pushwoosh', PushwooshManager::class);
    }

    /**
     * Register the bindings.
     *
     * @param \Illuminate\Contracts\Container\Container $app
     *
     * @return void
     */
    protected function registerBindings(Application $app)
    {
        $app->bind('pushwoosh.connection', function ($app) {
            $manager = $app['pushwoosh'];

            return $manager->connection();
        });

        $app->alias('pushwoosh.connection', Pushwoosh::class);
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
