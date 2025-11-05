<?php
namespace App\Models;

/**
 * Interface for weather API implementations to abstract common method.
 */
interface WeatherApiInterface {
    public function fetchWeather($cityName);
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

