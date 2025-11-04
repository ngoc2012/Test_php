<?php
namespace App\Models;

require_once __DIR__ . '/WeatherApi.php';

use App\Models\WeatherApiInterface;

class MockWeatherApi implements WeatherApiInterface {
    public function fetchWeather($cityName) {
        return ['temperature' => 18, 'humidity' => 65];
    }
}
?>