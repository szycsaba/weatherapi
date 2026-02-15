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
            'temperature' => $this->temp_c,
            'temp_min' => $this->temp_min_c,
            'temp_max' => $this->temp_max_c,
            'pressure' => $this->pressure,
            'humidity' => $this->humidity,
        ];
    }
}
