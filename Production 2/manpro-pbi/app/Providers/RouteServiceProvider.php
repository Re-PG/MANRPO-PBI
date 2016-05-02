<?php

namespace App\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function boot(Router $router)
    {
        //

        parent::boot($router);
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function map(Router $router, Request $request)
    {
        //$this->mapWebRoutes($router);
        $locale = $request->segment(1);
        if(in_array($locale,$this->app->config->get('app.skip_locales'))) {
            $this->skipLocaleRoutes($router);
        }else {
            $this->localeRoutes($router,$locale);
        }
    }
    /*$this->app->setLocale($locale);

        $router->group(['namespace' => $this->namespace , 'prefix' => $locale], function($router) {
          require app_path('Http/routes.php');
        });
    }*/

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    protected function mapWebRoutes(Router $router)
    {
        $router->group([
            'namespace' => $this->namespace, 'middleware' => 'web',
        ], function ($router) {
            require app_path('Http/routes.php');
        });
    }

    /**
      * Add a locale prefix to routes
      * @param  \Illuminate\Routing\Router $router $router
      * @param  string $locale
      * @return void
      */
    private function localeRoutes($router,$locale)
    {

        $this->app->setLocale($locale);

        $router->group(['namespace' => $this->namespace, 'prefix' => $locale], function($router) {
            require app_path('Http/routes.php');
        });
    }

    /**
      * Map routes without locale prefix
      * @param  \Illuminate\Routing\Router $router
      * @return void
      */
    private function skipLocaleRoutes($router)
    {
        $router->group(['namespace' => $this->namespace], function ($router) {
            require app_path('Http/routes.php');
        });
    }
}
