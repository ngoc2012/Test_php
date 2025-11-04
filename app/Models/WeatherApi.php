<?php
namespace App\Models;

interface WeatherApiInterface {
    public function fetchWeather($cityName);
}

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
?>
