<?php

namespace KoharaKazuya\LaravelOpenAPIValidatorMiddleware;

use Exception;
use HKarlstrom\Middleware\OpenApiValidation;
use Illuminate\Support\ServiceProvider;
use Psr\Http\Server\MiddlewareInterface;

class LaravelOpenAPIValidatorMiddlewareServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/laravelopenapivalidatormiddleware.php' => config_path('laravelopenapivalidatormiddleware.php'),
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->when(LaravelOpenAPIValidatorMiddleware::class)
            ->needs(MiddlewareInterface::class)
            ->give(function ($app) {
                /**
                 * @var \Illuminate\Contracts\Config\Repository $config
                 */
                $config = $app['config'];

                // get configurations
                $specfilepath = $config->get('laravelopenapivalidatormiddleware.specfilepath');
                if (empty($specfilepath)) {
                    $classname = self::class;
                    throw new Exception("Cannot find laravelopenapivalidatormiddleware.specfilepath configuration. Make sure that `php artisan vendor:publish --provider=\"$classname\"` and set appropriate path to specification file.");
                }
                $openapivalidationoptions = $config->get('laravelopenapivalidatormiddleware.openapivalidationoptions', []);

                return new OpenApiValidation($specfilepath, $openapivalidationoptions);
            });
    }
}
