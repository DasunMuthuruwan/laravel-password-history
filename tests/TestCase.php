<?php

namespace DevDasun\PasswordHistory\Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;
use YourVendor\PasswordHistory\PasswordHistoryServiceProvider;

abstract class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app): array
    {
        return [PasswordHistoryServiceProvider::class];
    }

    protected function defineEnvironment($app): void
    {
        $app['config']->set('database.default', 'testing');
    }
}