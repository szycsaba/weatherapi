<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeatherInfo extends Model
{
    protected $table = 'weather_infos';

    protected $fillable = [
        'time',
        'name',
        'lat',
        'lon',
        'temperature',
        'temp_min',
        'temp_max',
        'pressure',
        'humidity',
    ];

}
