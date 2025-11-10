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
     * @return History
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
        if (!$city->getId()) {
            $city_found = City::findByName($city->getName());
            if ($city_found) {
                $city->setId($city_found->getId());
            } else {
                $new_city = City::save($city->getName());
                $city->setId($new_city->getId());
            }
        }
        $history = History::transformDataToHistory([
            "cityId" => $city->getId(),
            "api" => $api->getApiName(),
            "temperature" => $temperature,
            "humidity" => $humidity
        ]);
        History::save($history);
        return $history;
    }
}
