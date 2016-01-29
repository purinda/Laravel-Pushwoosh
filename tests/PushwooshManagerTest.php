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
use GrahamCampbell\TestBench\AbstractTestCase as AbstractTestBenchTestCase;
use Hoy\Pushwoosh\PushwooshFactory;
use Hoy\Pushwoosh\PushwooshManager;
use Illuminate\Contracts\Config\Repository;
use Mockery;

/**
 * This is the Pushwoosh manager test class.
 *
 * @author Vincent Klaiber <vincent@hoy.se>
 */
class PushwooshManagerTest extends AbstractTestBenchTestCase
{
    public function testCreateConnection()
    {
        $config = ['path' => __DIR__];

        $manager = $this->getManager($config);

        $manager->getConfig()->shouldReceive('get')->once()
            ->with('pushwoosh.default')->andReturn('pushwoosh');

        $this->assertSame([], $manager->getConnections());

        $return = $manager->connection();

        $this->assertInstanceOf(Pushwoosh::class, $return);

        $this->assertArrayHasKey('pushwoosh', $manager->getConnections());
    }

    protected function getManager(array $config)
    {
        $repository = Mockery::mock(Repository::class);
        $factory = Mockery::mock(PushwooshFactory::class);

        $manager = new PushwooshManager($repository, $factory);

        $manager->getConfig()->shouldReceive('get')->once()
            ->with('pushwoosh.connections')->andReturn(['pushwoosh' => $config]);

        $config['name'] = 'pushwoosh';

        $manager->getFactory()->shouldReceive('make')->once()
            ->with($config)->andReturn(Mockery::mock(Pushwoosh::class));

        return $manager;
    }
}
