<?php

namespace App\Providers;

use App\Repositories\Document\DocumentRepo;
use App\Repositories\Document\IDocumentRepo;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(IDocumentRepo::class, DocumentRepo::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
