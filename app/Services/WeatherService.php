<?php
namespace App\Services;

use App\Models\City;
use App\Services\API\FreeWeatherApi;
use App\Services\API\OpenWeatherApi;
use App\Controllers\ErrorController;
use Exception;

/**
 * WeatherService class to fetch weather data
 */
class WeatherService {

    /**
     * Fetch weather metrics for a given city using the specified API.
     *
     * @param City $city The City object.
     * @param string|null $apiName The name of the API to use (optional).
     */
    public static function getData($city, $apiName = null) {
        switch ($apiName) {
            case 'FreeWeatherApi':
                $api = new FreeWeatherApi();
                break;
            default:
                $api = new OpenWeatherApi();
                break;
        }
        try {
            $api->fetchWeather($city);
        } catch (Exception $e) {
            (new ErrorController('smarty'))->index($e->getMessage());
            exit;
        }
        
    }
}
