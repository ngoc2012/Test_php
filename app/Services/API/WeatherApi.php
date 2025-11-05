<?php
namespace App\Services\API;

use App\Models\City;
/**
 * Interface for weather API implementations to abstract common method.
 */
interface WeatherApiInterface {
    /**
     * Fetch weather data for a given city.
     *
     * @param City $city The City object.
     */
    public function fetchWeather($city);
}

/**
 * Base class for all WeatherApi type
 */
abstract class WeatherApi implements WeatherApiInterface {
    protected $apiKey;
    protected $baseUrl;
    protected $cityNameEscaped;

    /**
     * Encode the city name for URL usage.
     *
     * @param string $cityName The name of the city.
     * @return string The URL-encoded city name.
     */
    protected function encodeCityName($cityName) {
        return urlencode($cityName);
    }
}

