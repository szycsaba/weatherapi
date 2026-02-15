<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\CityRepositoryInterface;
use App\Repositories\CityRepository;
use App\Repositories\WeatherInfoRepositoryInterface;
use App\Repositories\WeatherInfoRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(CityRepositoryInterface::class, CityRepository::class);
        $this->app->bind(WeatherInfoRepositoryInterface::class, WeatherInfoRepository::class);
    }
}