<?php

namespace App\Console\Commands;

use App\DTO\WeatherInfoInsertDto;
use App\Services\CityServices;
use App\Services\WeatherInfoService;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

class WeatherInfosCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weather:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This process will store weather data every 10 minutes.';

    /**
     * Execute the console command.
     */
    public function handle(CityServices $cityServices, WeatherInfoService $weatherInfoService): int
    {
        $appId = env('WEATHER_API_KEY');

        if (empty($appId)) {
            $this->error('Missing WEATHER_API_KEY in .env');
            return self::FAILURE;
        }

        $citiesResponse = $cityServices->getCities();

        if (!$citiesResponse->success) {
            $this->error($citiesResponse->message ?? 'Failed to fetch cities');
            return self::FAILURE;
        }

        $cities = $citiesResponse->data ?? [];

        foreach ($cities as $city) {
            $lat = $city['lat'] ?? null;
            $lon = $city['lon'] ?? null;

            if ($lat === null || $lon === null) {
                Log::warning('Skipping city due to missing coordinates', ['city' => $city]);
                continue;
            }

            $fullUrl = "https://api.openweathermap.org/data/2.5/weather?lat=".$lat."&lon=".$lon."&appid=".$appId."&units=metric";

            try {
                $response = Http::timeout(15)->get($fullUrl);

                if (!$response->successful()) {
                    Log::error('OpenWeather API call failed', [
                        'status' => $response->status(),
                        'body' => $response->body(),
                        'lat' => $lat,
                        'lon' => $lon,
                    ]);
                    continue;
                }

                $payload = $response->json();

                $dto = new WeatherInfoInsertDto(
                    time: Carbon::createFromTimestamp((int) ($payload['dt'] ?? time())),
                    name: (string) ($payload['name'] ?? ($city['name'] ?? '')),
                    lat: (float) ($payload['coord']['lat'] ?? $lat),
                    lon: (float) ($payload['coord']['lon'] ?? $lon),
                    temperature: (float) ($payload['main']['temp'] ?? 0),
                    temp_min: (float) ($payload['main']['temp_min'] ?? 0),
                    temp_max: (float) ($payload['main']['temp_max'] ?? 0),
                    pressure: (int) ($payload['main']['pressure'] ?? 0),
                    humidity: (int) ($payload['main']['humidity'] ?? 0),
                );

                $insertResponse = $weatherInfoService->insertWeatherInfo($dto);

                if (!$insertResponse->success) {
                    Log::error('Failed to store weather info', [
                        'message' => $insertResponse->message,
                        'city' => $city,
                        'lat' => $lat,
                        'lon' => $lon,
                    ]);
                }
            } catch (Throwable $e) {
                Log::error('Unexpected error while processing city weather', [
                    'message' => $e->getMessage(),
                    'city' => $city,
                    'lat' => $lat,
                    'lon' => $lon,
                ]);
            }
        }

        $this->info('Weather cron finished.');
        return self::SUCCESS;
    }
}
