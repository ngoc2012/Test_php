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
     * Fetch weather data for a given city.
     *
     * @param City $city The City object.
     */
    abstract public function fetchWeather($city);
}

