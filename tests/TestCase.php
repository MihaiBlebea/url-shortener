<?php

use SerbanBlebea\UrlShortener\UrlShortenerServiceProvider;

abstract class TestCase extends Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return [UrlShortenerServiceProvider::class];
    }

    public function setUp()
    {
        parent::setUp();

        Eloquent::unguard();

        $this->artisan('migrate', [
            '--database' => 'testbench',
            '--path' => realpath(__DIR__ . '/../migrations'),
        ]);
    }

    public function tearDown()
    {
        \Schema::drop('links');
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'testbench');

        $app['config']->set('database.connections.testbench', [
            'driver'   => 'mysql',
            'database' => ':memory:',
            'prefix'   => '',
            'host'     => 'localhost',
            'database' => 'laravel_playground',
            'username' => 'root',
            'password' => ''
        ]);

        \Schema::create('links', function ($table) {
            $table->increments('id');
            $table->string('name');
            $table->string('unique_id');
            $table->string('destination_link');
            $table->integer('count')->default(0);
            $table->string('campaign')->nullable();
            $table->string('source')->nullable();
            $table->string('medium')->nullable();
            $table->timestamp('reset_date')->nullable();
            $table->timestamps();
        });
    }
}
