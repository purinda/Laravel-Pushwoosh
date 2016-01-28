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

use GrahamCampbell\Manager\AbstractManager;
use Illuminate\Contracts\Config\Repository;

/**
 * This is the Pushwoosh manager class.
 *
 * @author Vincent Klaiber <vincent@hoy.se>
 */
class PushwooshManager extends AbstractManager
{
    /**
     * The factory instance.
     *
     * @var \Hoy\Pushwoosh\PushwooshFactory
     */
    private $factory;

    /**
     * Create a new Pushwoosh manager instance.
     *
     * @param \Illuminate\Contracts\Config\Repository $config
     * @param \Hoy\Pushwoosh\PushwooshFactory         $factory
     *
     * @return void
     */
    public function __construct(Repository $config, PushwooshFactory $factory)
    {
        parent::__construct($config);

        $this->factory = $factory;
    }

    /**
     * Create the connection instance.
     *
     * @param array $config
     *
     * @return mixed
     */
    protected function createConnection(array $config)
    {
        return $this->factory->make($config);
    }

    /**
     * Get the configuration name.
     *
     * @return string
     */
    protected function getConfigName()
    {
        return 'pushwoosh';
    }

    /**
     * Get the factory instance.
     *
     * @return \Hoy\Pushwoosh\PushwooshFactory
     */
    public function getFactory()
    {
        return $this->factory;
    }
}
