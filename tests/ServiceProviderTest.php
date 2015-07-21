<?php

/*
 * This file is part of Laravel Pushwoosh.
 *
 * (c) Schimpanz Solutions AB <info@schimpanz.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Schimpanz\Tests\Pushwoosh;

use Gomoob\Pushwoosh\Client\Pushwoosh;
use GrahamCampbell\TestBenchCore\ServiceProviderTrait;
use Schimpanz\Pushwoosh\PushwooshFactory;
use Schimpanz\Pushwoosh\PushwooshManager;

/**
 * This is the service provider test class.
 *
 * @author Vincent Klaiber <vincent@schimpanz.com>
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
