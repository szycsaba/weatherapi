<?php

namespace App\Repositories;

use App\DTO\WeatherInfoInsertDto;
use App\Models\WeatherInfo;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class WeatherInfoRepository implements WeatherInfoRepositoryInterface
{
    public function insertWeatherInfo(WeatherInfoInsertDto $dto): WeatherInfo
    {
        $weatherInfo = new WeatherInfo([
            'time' => $dto->time,
            'name' => $dto->name,
            'lat' => $dto->lat,
            'lon' => $dto->lon,
            'temperature' => $dto->temperature,
            'temp_min' => $dto->temp_min,
            'temp_max' => $dto->temp_max,
            'pressure' => $dto->pressure,
            'humidity' => $dto->humidity,
        ]);
        $weatherInfo->save();

        return $weatherInfo->refresh();
    }
}
