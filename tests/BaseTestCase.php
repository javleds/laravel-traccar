<?php

namespace Javleds\Traccar\Tests;

use Javleds\Traccar\TraccarServiceProvider;
use Orchestra\Testbench\TestCase;

class BaseTestCase extends TestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            TraccarServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app): array
    {
        return [];
    }
}
