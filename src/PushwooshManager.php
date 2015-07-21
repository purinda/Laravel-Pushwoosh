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

use GrahamCampbell\Manager\AbstractManager;
use Illuminate\Contracts\Config\Repository;

/**
 * This is the Pushwoosh manager class.
 *
 * @author Vincent Klaiber <vincent@schimpanz.com>
 */
class PushwooshManager extends AbstractManager
{
    /**
     * The factory instance.
     *
     * @var \Schimpanz\Pushwoosh\PushwooshFactory
     */
    private $factory;

    /**
     * Create a new Pushwoosh manager instance.
     *
     * @param \Illuminate\Contracts\Config\Repository $config
     * @param \Schimpanz\Pushwoosh\PushwooshFactory         $factory
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
     * @return \Schimpanz\Pushwoosh\PushwooshFactory
     */
    public function getFactory()
    {
        return $this->factory;
    }
}
