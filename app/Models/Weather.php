<?php
namespace App\Models;

require_once __DIR__ . '/History.php';
require_once __DIR__ . '/WeatherApi.php';
require_once __DIR__ . '/FreeWeatherApi.php';
require_once __DIR__ . '/OpenWeatherApi.php';
require_once __DIR__ . '/../Core/Database.php';
require_once __DIR__ . '/../Controllers/ErrorController.php';

use App\Models\History;
use App\Controllers\ErrorController;
use Exception;

/**
 * Weather model class
 */
class Weather {

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
