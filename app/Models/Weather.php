<?php
namespace App\Models;

require_once __DIR__ . '/WeatherApi.php';
require_once __DIR__ . '/OpenWeatherApi.php';
require_once __DIR__ . '/WeatherMetrics.php';

use App\Models\WeatherApiInterface;
use App\Models\OpenWeatherApi;
use App\Models\WeatherMetrics;

class Weather {

    public static function getMetrics($city, WeatherApiInterface $api = null) {
        if ($api === null) {
            $api = new OpenWeatherApi();
        }
        $weatherData = $api->fetchWeather($city);
        $metrics = new WeatherMetrics(
            $weatherData['temp'],
            $weatherData['humidity']
        );
        return $metrics->toArray();
    }
}
?>
