<?php

namespace Fh\RequestServer\Tests;

use Fh\RequestServer\RequestServerServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            RequestServerServiceProvider::class,
        ];
    }
}
