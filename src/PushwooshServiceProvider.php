<?php

/*
 * This file is part of Laravel Pushwoosh.
 *
 * (c) Schimpanz Solutions AB <info@schimpanz.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Schimpanz\Pushwoosh;

use Gomoob\Pushwoosh\Client\Pushwoosh;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

/**
 * This is the Pushwoosh service provider class.
 *
 * @author Vincent Klaiber <vincent@schimpanz.com>
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

        if (class_exists('Illuminate\Foundation\Application', false)) {
            $this->publishes([$source => config_path('pushwoosh.php')]);
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
     * @param \Illuminate\Contracts\Foundation\Application $app
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
     * @param \Illuminate\Contracts\Foundation\Application $app
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
     * @param \Illuminate\Contracts\Foundation\Application $app
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