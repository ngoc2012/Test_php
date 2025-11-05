<?php
namespace App\Models;

use App\Models\History;
use App\Models\FreeWeatherApi;
use App\Models\OpenWeatherApi;
use App\Controllers\ErrorController;
use Exception;

/**
 * WeatherService class to fetch weather data
 */
class WeatherService {

    /**
     * Fetch weather metrics for a given city using the specified API.
     *
     * @param int $cityId The ID of the city.
     * @param string $cityName The name of the city.
     * @param string|null $apiName The name of the API to use (optional).
     * @return History The History object.
     */
    public static function getData($cityId, $cityName, $apiName = null) {
        switch ($apiName) {
            case 'FreeWeatherApi':
                $api = new FreeWeatherApi();
                break;
            default:
                $api = new OpenWeatherApi();
                break;
        }
        try {
            $weatherData = $api->fetchWeather($cityName);
            $weather = new History($cityId, $apiName, $weatherData['temperature'], $weatherData['humidity']);
            return $weather;
        } catch (Exception $e) {
            (new ErrorController('smarty'))->error($e->getMessage());
            exit;
        }
        
    }
}
