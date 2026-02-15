<?php

namespace App\Repositories;

use App\DTO\WeatherInfoInsertDto;
use App\Models\WeatherInfo;
use Illuminate\Database\Eloquent\Collection;

interface WeatherInfoRepositoryInterface
{
    public function insertWeatherInfo(WeatherInfoInsertDto $dto): WeatherInfo;
    public function getStoredWeatherInfos(?int $page = null): Collection;
    public function getLast24HoursByCityName(string $cityName): Collection;
}
