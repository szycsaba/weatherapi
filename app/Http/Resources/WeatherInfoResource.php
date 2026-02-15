<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WeatherInfoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'time' => $this->time,
            'name' => $this->name,
            'lat' => $this->lat,
            'lon' => $this->lon,
            'temperature' => $this->temperature,
            'temp_min' => $this->temp_min,
            'temp_max' => $this->temp_max,
            'pressure' => $this->pressure,
            'humidity' => $this->humidity,
        ];
    }
}
