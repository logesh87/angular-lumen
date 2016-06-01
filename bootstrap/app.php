<?php

require_once __DIR__.'/../vendor/autoload.php';

try {
    (new Dotenv\Dotenv(__DIR__.'/../'))->load();
} catch (Dotenv\Exception\InvalidPathException $e) {
    //
}

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| Here we will load the environment and create the application instance
| that serves as the central piece of this framework. We'll use this
| application as an "IoC" container and router for this framework.
|
*/

$app = new Laravel\Lumen\Application(
    realpath(__DIR__.'/../')
);


$app->withFacades();

$app->withEloquent();

/*
|--------------------------------------------------------------------------
| Register Container Bindings
|--------------------------------------------------------------------------
|
| Now we will register a few bindings in the service container. We will
| register the exception handler and the console kernel. You may add
| your own bindings here if you like or you can make another file.
|
*/

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

//Mobile Detect
$app['device']  =  $app->share(function()
{
    return new Detection\MobileDetect();
});


//device detect
if (! function_exists('device'))
{
    function device($key)
    {
        switch($key)
        {
            case 'isMobile':
                return app('device')->isMobile() == 1;
            break;
            
            case 'isTablet':
                return app('device')->isTablet() == 1;
            break;
            case 'lg_pag':
                $user_agent =   app('device')->getUserAgent();
                return (mb_stripos($user_agent, 'LG-V400', 0, 'UTF-8') !== false) ? true : false;
            break;
        
            default:
                return false;
        }
    }
}

// Need to enable the laravel config facade based on environment-- maybe find a better way
class_alias('Illuminate\Support\Facades\Config', 'Config');
$app->configure('app');

//write a helper
if (! function_exists('conf')) {
   
    function conf($key)
    {
        return Config::get('app.'.$key);
    }
}

define('DHL_CONF_API_DIR', rtrim( app()->basePath('config/') ));
/*
|--------------------------------------------------------------------------
| Register Middleware
|--------------------------------------------------------------------------
|
| Next, we will register the middleware with the application. These can
| be global middleware that run before and after each request into a
| route or middleware that'll be assigned to some specific routes.
|
*/

$app->middleware([   
   App\Http\Middleware\JsonRequestMiddleware::class
]);

$app->routeMiddleware([
    //'auth' => App\Http\Middleware\Authenticate::class,
    
]);

/*
|--------------------------------------------------------------------------
| Register Service Providers
|--------------------------------------------------------------------------
|
| Here we will register all of the application's service providers which
| are used to bind services into the container. Service providers are
| totally optional, so you are not required to uncomment this line.
|
*/
$app->register('App\Providers\LoggerServiceProvider');
// $app->register(App\Providers\AppServiceProvider::class);
// $app->register(App\Providers\AuthServiceProvider::class);
// $app->register(App\Providers\EventServiceProvider::class);
//$app->register('Nord\Lumen\Cors\CorsServiceProvider');
$app->register(Irazasyed\Larasupport\Providers\ArtisanServiceProvider::class);
$app->register(Vluzrmos\Tinker\TinkerServiceProvider::class);
$app->register(GenTux\Jwt\Support\LumenServiceProvider::class);
/*
|--------------------------------------------------------------------------
| Load The Application Routes
|--------------------------------------------------------------------------
|
| Next we will include the routes file so that they can all be added to
| the application. This will provide all of the URLs the application
| can respond to, as well as the controllers that may handle them.
|
*/

$app->group(['namespace' => 'App\Http\Controllers'], function ($app) {

    require __DIR__.'/../app/Http/routes.php';
});

return $app;
