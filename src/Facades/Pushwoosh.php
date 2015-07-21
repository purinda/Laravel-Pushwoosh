<?php

/*
 * This file is part of Laravel Pushwoosh.
 *
 * (c) Schimpanz Solutions AB <info@schimpanz.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Schimpanz\Pushwoosh\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * This is the Pushwoosh facade class.
 *
 * @author Vincent Klaiber <vincent@schimpanz.com>
 */
class Pushwoosh extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'pushwoosh';
    }
}
