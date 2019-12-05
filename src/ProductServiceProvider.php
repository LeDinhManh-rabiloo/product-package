<?php

namespace Manhle\ProductPackage;

use Illuminate\Support\ServiceProvider;

class ProductServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__.'/views/backs/pages/product', 'index');
        $this->loadViewsFrom(__DIR__.'/views/backs/pages/product', 'edit');
        $this->loadViewsFrom(__DIR__.'/views/backs/pages/product', 'form');
        $this->loadViewsFrom(__DIR__.'/views/backs/pages/product', 'formUpdate');
        $this->loadViewsFrom(__DIR__.'/views/backs/pages/product', 'images');
        $this->loadViewsFrom(__DIR__.'/views/backs/pages/product', 'name');
        $this->loadViewsFrom(__DIR__.'/views/backs/pages/product', 'slug');
        $this->loadViewsFrom(__DIR__.'/views/backs/pages/product', 'status');
        $this->loadViewsFrom(__DIR__.'/views/backs/pages/product', 'description');
        $this->loadViewsFrom(__DIR__.'/views/backs/pages/product', 'create');
        $this->loadViewsFrom(__DIR__.'/views/backs/pages/product', 'actions');
        $this->loadViewsFrom(__DIR__. 'stubs/datatables', 'builder');
        $this->loadViewsFrom(__DIR__. 'stubs/datatables', 'datatables');
        $this->loadViewsFrom(__DIR__. 'stubs/datatables', 'html');
        $this->loadViewsFrom(__DIR__. 'stubs/datatables', 'scopes');
        $this->loadMigrationsFrom(__DIR__.'database/migrations');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
