<?php
namespace Yeoji\ParshCMS\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

class ParshServiceProvider extends ServiceProvider
{

    public function boot()
    {
        require __DIR__ . '/../../vendor/autoload.php';
        $this->setupRoutes($this->app->router);
        $this->loadViewsFrom(__DIR__.'/../../views', 'parshcms');
        $this->loadViewsFrom(storage_path('app/yeoji/parshCMS/templates'), 'parshtemplates');

        // publishing public assets
        $this->publishes([
            __DIR__.'/../../public' => public_path('yeoji/parsh-cms'),
        ], 'public');

        // publishing migrations
        $this->publishes([
            __DIR__.'/../../database/migrations/' => database_path('migrations')
        ], 'migrations');
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router $router
     * @return void
     */
    private function setupRoutes(Router $router)
    {
        $router->group(['prefix' => 'parsh-admin', 'namespace' => 'Yeoji\ParshCMS\Http\Controllers'], function ($router) {
            require __DIR__ . '/../Http/routes.php';
        });
    }

    public function register()
    {
        $this->registerStorage();
    }

    /**
     * Registers the bindings for repositories
     */
    private function registerStorage()
    {
        $this->app->bind('\Yeoji\ParshCMS\Repositories\Interfaces\ThemeRepository', '\Yeoji\ParshCMS\Repositories\Eloquent\EloquentThemeRepository');
    }

}
