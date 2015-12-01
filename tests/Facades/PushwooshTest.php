<?php

/*
 * This file is part of Laravel Pushwoosh.
 *
 * (c) Schimpanz Solutions AB <info@schimpanz.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Schimpanz\Tests\Pushwoosh\Facades;

use GrahamCampbell\TestBenchCore\FacadeTrait;
use Schimpanz\Pushwoosh\Facades\Pushwoosh;
use Schimpanz\Pushwoosh\PushwooshManager;
use Schimpanz\Tests\Pushwoosh\AbstractTestCase;

/**
 * This is the Pushwoosh facade test class.
 *
 * @author Vincent Klaiber <vincent@schimpanz.com>
 */
class PushwooshTest extends AbstractTestCase
{
    use FacadeTrait;

    /**
     * Get the facade accessor.
     *
     * @return string
     */
    protected function getFacadeAccessor()
    {
        return 'pushwoosh';
    }

    /**
     * Get the facade class.
     *
     * @return string
     */
    protected function getFacadeClass()
    {
        return Pushwoosh::class;
    }

    /**
     * Get the facade root.
     *
     * @return string
     */
    protected function getFacadeRoot()
    {
        return PushwooshManager::class;
    }
}
