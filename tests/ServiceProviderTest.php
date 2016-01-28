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

use Gomoob\Pushwoosh\Client\Pushwoosh;
use GrahamCampbell\TestBenchCore\ServiceProviderTrait;
use Hoy\Pushwoosh\PushwooshFactory;
use Hoy\Pushwoosh\PushwooshManager;

/**
 * This is the service provider test class.
 *
 * @author Vincent Klaiber <vincent@hoy.se>
 */
class ServiceProviderTest extends AbstractTestCase
{
    use ServiceProviderTrait;

    public function testPushwooshFactoryIsInjectable()
    {
        $this->assertIsInjectable(PushwooshFactory::class);
    }

    public function testPushwooshManagerIsInjectable()
    {
        $this->assertIsInjectable(PushwooshManager::class);
    }

    public function testBindings()
    {
        $this->assertIsInjectable(Pushwoosh::class);

        $original = $this->app['pushwoosh.connection'];
        $this->app['pushwoosh']->reconnect();
        $new = $this->app['pushwoosh.connection'];

        $this->assertNotSame($original, $new);
        $this->assertEquals($original, $new);
    }
}
