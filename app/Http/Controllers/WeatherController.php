<?php

namespace App\Http\Controllers;

use App\Http\Requests\WeatherInfoRequest;
use App\Services\WeatherInfoService;
use Illuminate\Http\JsonResponse;

class WeatherController extends Controller
{
    public function getStoredWeatherInfos(WeatherInfoService $weatherInfoService, WeatherInfoRequest $request): JsonResponse 
    {
        $page = $request->validated('page');

        $response = $weatherInfoService->getStoredWeatherInfos($page);

        return response()->json($response->toArray(), $response->status);
    }
}
