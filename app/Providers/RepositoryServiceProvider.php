<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\CityRepositoryInterface;
use App\Repositories\CityRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(CityRepositoryInterface::class, CityRepository::class);
    }
}