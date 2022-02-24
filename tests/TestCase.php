<?php

namespace FruiVita\Corporate\Tests;

use FruiVita\Corporate\CorporateServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Schema;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            // @phpstan-ignore-next-line
            fn ($modelName) => 'FruiVita\\Corporate\\Database\\Factories\\' . class_basename($modelName) . 'Factory'
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function getPackageProviders($app): array
    {
        return [
            CorporateServiceProvider::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    protected function getEnvironmentSetUp($app): void
    {
        Schema::dropAllTables();

        $files = glob(__DIR__ . '/../database/migrations/*.php.stub', GLOB_NOSORT);
        $table = include __DIR__ . '/../database/migrations/create_duties_table.php.stub';
        $table->up();
        $table = include __DIR__ . '/../database/migrations/create_departments_table.php.stub';
        $table->up();
        $table = include __DIR__ . '/../database/migrations/create_occupations_table.php.stub';
        $table->up();
        $table = include __DIR__ . '/../database/migrations/create_persons_table.php.stub';
        $table->up();
        // foreach ($files as $file) {
        //     $table = include $file;
        // }
    }
}
