<?php
namespace App\Services;

use App\Models\City;
use App\Models\History;
use App\Services\API\FreeWeatherApi;
use App\Services\API\OpenWeatherApi;

/**
 * WeatherService class to fetch weather data
 */
class WeatherService {


    // ======================
    // === Public methods ===
    // ======================

    /**
     * Fetch weather metrics for a given city using the specified API.
     *
     * @param City $city The City object.
     * @param string|null $apiName The name of the API to use (optional).
     * @return void
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
        list($temperature, $humidity) = $api->fetchWeather($city);
        $history = History::transformDataToHistory([
            "cityId" => $city->getId(),
            "api" => $apiName,
            "temperature" => $temperature,
            "humidity" => $humidity
        ]);
        History::save($history);
    }
}
