<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contract\NegaraRepositoryInterface;
use App\Repositories\NegaraRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(NegaraRepositoryInterface::class, NegaraRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
