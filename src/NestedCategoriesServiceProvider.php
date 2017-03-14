<?php
/**
 * NestedCategoriesServiceProvider
 */
namespace Delatbabel\NestedCategories;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Support\ServiceProvider;

/**
 * NestedCategoriesServiceProvider
 */
class NestedCategoriesServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Boot the service provider.
     *
     * This method is called after all other service providers have
     * been registered, meaning you have access to all other services
     * that have been registered by the framework.
     *
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        if (method_exists('Illuminate\\Support\\ServiceProvider', 'boot')) {
            parent::boot($events);
        }

        // Publish the database migrations and seeds
        $this->publishes([
            __DIR__ . '/../database/migrations' => $this->app->databasePath() . '/migrations'
        ], 'migrations');
        $this->publishes([
            __DIR__ . '/../database/seeds' => $this->app->databasePath() . '/seeds'
        ], 'seeds');
        $this->publishes([
            __DIR__ . '/../config' => config_path()
        ], 'config');

        // Register other providers required by this provider, which saves the caller
        // from having to register them each individually.
        $this->app->register(\Baum\Providers\BaumServiceProvider::class);
        $this->app->register(\Cviebrock\EloquentSluggable\ServiceProvider::class);
    }

    /**
     * Register the service provider.
     *
     * Within the register method, you should only bind things into the
     * service container. You should never attempt to register any event
     * listeners, routes, or any other piece of functionality within the
     * register method.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
