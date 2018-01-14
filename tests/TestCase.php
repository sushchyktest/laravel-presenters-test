<?php

namespace Sushchyk\Presenters\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Orchestra\Database\ConsoleServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;
use Orchestra\Testbench\Traits\WithFactories;
use Sushchyk\Presenters\PresentersServiceProvider;

abstract class TestCase extends Orchestra
{
    use RefreshDatabase;
    use WithFactories;

    public function setUp()
    {
        parent::setUp();
        $this->withFactories(__DIR__ . '/database/factories');
        $this->loadMigrationsFrom([
           '--path'  => '/../../../../tests/database/migrations',
           '--database' => 'testbench'
        ]);
    }

    /**
     * Get package provider for tests.
     *
     * @param \Illuminate\Foundation\Application $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            ConsoleServiceProvider::class,
            PresentersServiceProvider::class,
        ];
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        // set up database configuration
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }
}
