<?php
namespace App\Services\API;

use App\Models\City;
use Exception;
/**
 * Base class for all WeatherApi type
 */
abstract class AbstractWeatherApi { // implements WeatherApiInterface {
    protected $apiKey;
    protected $baseUrl;
    protected $apiName;

    /**
     * Encode the city name for URL usage.
     *
     * @param string $cityName The name of the city.
     * @return string The URL-encoded city name.
     */
    protected function encodeCityName($cityName) {
        return urlencode($cityName);
    }

    /**
     * Validate the API response data.
     * @param float $temperature
     * @param float $humidity
     * @throws Exception
     */
    protected function dataCheck($temperature, $humidity) {
        if (!is_numeric($temperature)) {
            throw new Exception("Temperature value is not numeric.");
        }
        if (!is_numeric($humidity)) {
            throw new Exception("Humidity value is not numeric.");
        }
        if ($temperature < 0) {
            throw new Exception("Temperature value is invalid.");
        }
        if ($humidity < 0 || $humidity > 100) {
            throw new Exception("Humidity value is invalid.");
        }
    }

    /**
     * Fetch weather data for a given city.
     *
     * @param City $city The City object.
     */
    abstract public function fetchWeather($city);
}

