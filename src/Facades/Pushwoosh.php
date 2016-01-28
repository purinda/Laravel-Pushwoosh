<?php

/*
 * This file is part of Laravel Pushwoosh.
 *
 * (c) HOY Multimedia AB <info@hoy.se>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hoy\Pushwoosh\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * This is the Pushwoosh facade class.
 *
 * @author Vincent Klaiber <vincent@hoy.se>
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
