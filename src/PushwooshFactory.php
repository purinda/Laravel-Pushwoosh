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

use InvalidArgumentException;
use Gomoob\Pushwoosh\Client\Pushwoosh;

/**
 * This is the Pushwoosh factory class.
 *
 * @author Vincent Klaiber <vincent@schimpanz.com>
 */
class PushwooshFactory
{
    /**
     * Make a new Pushwoosh client.
     *
     * @param array $config
     *
     * @return \Gomoob\Pushwoosh\Client\Pushwoosh
     */
    public function make(array $config)
    {
        $config = $this->getConfig($config);

        return $this->getClient($config);
    }

    /**
     * Get the configuration data.
     *
     * @param string[] $config
     *
     * @throws \InvalidArgumentException
     *
     * @return array
     */
    protected function getConfig(array $config)
    {
        $keys = ['app', 'token'];

        foreach ($keys as $key) {
            if (!array_key_exists($key, $config)) {
                throw new InvalidArgumentException("Missing configuration key [$key].");
            }
        }

        return array_only($config, $keys);
    }

    /**
     * Get the Pushwoosh client.
     *
     * @param string[] $auth
     *
     * @return \Gomoob\Pushwoosh\Client\Pushwoosh
     */
    protected function getClient(array $auth)
    {
        return Pushwoosh::create()
            ->setApplication($auth['app'])
            ->setAuth($auth['token']);
    }
}
