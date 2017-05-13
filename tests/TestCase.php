<?php 

use SerbanBlebea\UrlShortener\UrlShortenerServiceProvider;

abstract class TestCase extends Orchestra\TestBench\TestCase
{
    protected function getPackageProvider($app)
    {
        return [UrlShortenerServiceProvider::class];
    }

    public function setUp()
    {
        parent::setUp();

        Eloquent::unguard();

        $this->artisan('migrate', [
            '--database' => 'testbench',
            '--realpath' => realpath(__DIR__ . '/../migrations'),
        ]);
    }

    protected function getEnvironmentSetup($app)
    {
        $app['config']->set('database.default', 'testbench');

        $app['config']->set('database.connections.testbench', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
    }
}