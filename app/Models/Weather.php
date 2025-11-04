<?php
namespace App\Models;

require_once __DIR__ . '/WeatherApi.php';

use App\Models\WeatherApiInterface;

class Weather {

    public static function getMetrics($city, $apiName = null) {
        switch ($apiName) {
            case 'FreeWeatherApi':
                require_once __DIR__ . '/FreeWeatherApi.php';
                $api = new FreeWeatherApi();
                break;
            default:
                require_once __DIR__ . '/OpenWeatherApi.php';
                $api = new OpenWeatherApi();
                break;
        }
        $weatherData = $api->fetchWeather($city);
        return [
            'api' => $apiName,
            'temperature' => $weatherData['temperature'],
            'humidity' => $weatherData['humidity']
        ];
    }
}
?>
