<?php

namespace App\Providers;

use App\Http\ResponseFactory;
use Illuminate\Contracts\Routing\ResponseFactory as ResponseFactoryContract;
use Illuminate\Support\ServiceProvider;

class ResponseApiProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ResponseFactoryContract::class, function ($app) {
            return new ResponseFactory($app['view'], $app['redirect']);
        });
    }
}
