<?php

namespace App\Providers;

use App\Managers\ProductManager;
use App\Repositories\ProductRepository;
use App\Storages\JsonStorage;
use Illuminate\Support\ServiceProvider;

/**
 * Class StorageServiceProvider
 * @package App\Providers
 */
class StorageServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton("App\\Storages\\JsonStorage", function () {
            return new JsonStorage($this->app['files'], storage_path("app/products.json"));
        });

        $this->app->bind("App\\Repositories\\ProductRepository", function () {
            return new ProductRepository($this->app["App\\Storages\\JsonStorage"]);
        });

        $this->app->bind("App\\Repositories\\ProductManager", function () {
            return new ProductManager($this->app["App\\Storages\\JsonStorage"]);
        });
    }
}