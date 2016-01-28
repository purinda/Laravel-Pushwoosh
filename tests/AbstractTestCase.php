<?php

/*
 * This file is part of Laravel Pushwoosh.
 *
 * (c) HOY Multimedia AB <info@hoy.se>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hoy\Tests\Pushwoosh;

use GrahamCampbell\TestBench\AbstractPackageTestCase;
use Hoy\Pushwoosh\PushwooshServiceProvider;

/**
 * This is the abstract test class.
 *
 * @author Vincent Klaiber <vincent@hoy.se>
 */
abstract class AbstractTestCase extends AbstractPackageTestCase
{
    /**
     * Get the service provider class.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return string
     */
    protected function getServiceProviderClass($app)
    {
        return PushwooshServiceProvider::class;
    }
}
