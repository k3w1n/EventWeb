<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherForecastApi extends Controller
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = '5628a65a9d4b5f5848aa8decf2f5f319';
    }

    public static function getWeatherForecast($lat, $lon)
    {
        $response = Http::get('https://api.openweathermap.org/data/2.5/weather', [
            'lat' => $lat,
            'appid' => '5628a65a9d4b5f5848aa8decf2f5f319',
            'units' => 'metric', // You can change the unit to imperial for Fahrenheit
        ]);

        if ($response->failed()) {
            return 'Gagal mendapatkan perkiraan cuaca';
        }

        $weather = $response['weather'];
        return $weather[0]['main'];
    }
}
