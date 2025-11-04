<?php
namespace App\Models;

require_once __DIR__ . '/WeatherApi.php';

use App\Models\WeatherApiInterface;

class Weather {
    /**
     * Fetch weather metrics for a given city using the specified API.
     *
     * @param string $city The name of the city.
     * @param string|null $apiName The name of the API to use (optional).
     * @return array An associative array containing 'api', 'temperature', and 'humidity'.
     * @throws \Exception If the API fetch fails.
     */
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
