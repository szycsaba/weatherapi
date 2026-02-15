<?php

namespace App\Repositories;

use App\DTO\WeatherInfoInsertDto;
use App\Models\WeatherInfo;

interface WeatherInfoRepositoryInterface
{
    public function insertWeatherInfo(WeatherInfoInsertDto $dto): WeatherInfo;
}
