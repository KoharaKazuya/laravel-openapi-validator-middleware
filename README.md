# Laravel OpenAPI Validator Middleware

Laravel middleware validates requests and responses by an OpenAPI specification document.

## Installation

```console
$ composer require koharakazuya/laravel-openapi-validator-middleware
$ php artisan vendor:publish --provider="KoharaKazuya\LaravelOpenAPIValidatorMiddleware\LaravelOpenAPIValidatorMiddlewareServiceProvider"
```

## Usage

Modify configurations in `config/laravelopenapivalidatormiddleware.php`.

Append a middleware to `app/Http/Kernel.php`.

```diff
      protected $middleware = [
          // other middlewares...
+         \KoharaKazuya\LaravelOpenAPIValidatorMiddleware\LaravelOpenAPIValidatorMiddleware::class,
      ];
```
