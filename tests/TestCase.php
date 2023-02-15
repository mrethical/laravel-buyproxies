<?php

namespace Mrethical\BuyProxies\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Mrethical\BuyProxies\BuyProxiesServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Mrethical\\BuyProxies\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            BuyProxiesServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        /*
        $migration = include __DIR__.'/../database/migrations/create_laravel-buyproxies_table.php.stub';
        $migration->up();
        */
    }
}
