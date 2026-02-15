<?php

namespace App\Services;

use App\DTO\ServiceResponse;
use App\DTO\WeatherInfoInsertDto;
use App\Http\Resources\WeatherInfoResource;
use App\Repositories\WeatherInfoRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;

class WeatherInfoService 
{
    public function __construct(
        private WeatherInfoRepositoryInterface $repo
    ) {}

    public function insertWeatherInfo(WeatherInfoInsertDto $dto): ServiceResponse
    {
        try {
            $weatherInfo = $this->repo->insertWeatherInfo($dto);

            return new ServiceResponse(
                success: true,
                message: 'Weather info created successfully',
                data: WeatherInfoResource::make($weatherInfo)->resolve(),
                status: 201
            );
        } catch (QueryException $e) {
            Log::error('An error occurred while creating weather info: ' . $e->getMessage());
            return new ServiceResponse(
                success: false,
                message: 'An error occurred while creating weather info',
                status: 500
            );
        }
    }

    public function getStoredWeatherInfos(?int $page = null): ServiceResponse
    {
        try {
            $weatherInfos = $this->repo->getStoredWeatherInfos($page);

            return new ServiceResponse(
                success: true,
                message: 'Weather infos listed successfully',
                data: WeatherInfoResource::collection($weatherInfos)->resolve(),
                status: 200
            );
        } catch (QueryException $e) {
            Log::error('An error occurred while fetching weather infos: ' . $e->getMessage());
            return new ServiceResponse(
                success: false,
                message: 'An error occurred while fetching weather infos',
                status: 500
            );
        }
    }
}