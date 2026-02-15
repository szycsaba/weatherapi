<?php

namespace App\DTO;

use DateTimeInterface;

class WeatherInfoInsertDto
{
    public function __construct(
        public DateTimeInterface|string $time,
        public string $name,
        public float $lat,
        public float $lon,
        public float $temperature,
        public float $temp_min,
        public float $temp_max,
        public float|int $pressure,
        public float|int $humidity,
    ) {}
}

