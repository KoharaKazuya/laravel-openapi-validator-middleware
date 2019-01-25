<?php

namespace KoharaKazuya\LaravelOpenAPIValidatorMiddleware;

use Closure;
use KoharaKazuya\LaravelPSR15Middleware\LaravelPSR15MiddlewareFactory;
use Psr\Http\Server\MiddlewareInterface;

class LaravelOpenAPIValidatorMiddleware
{
    private $delegate;

    public function __construct(LaravelPSR15MiddlewareFactory $middlewareFactory, MiddlewareInterface $openapiValidatorMiddleware)
    {
        $this->delegate = $middlewareFactory->createMiddleware($openapiValidatorMiddleware);
    }

    /**
     * Laravel compatible middleware handle method
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     * @throws
     */
    public function handle($request, Closure $next)
    {
        return $this->delegate->handle($request, $next);
    }
}