<?php
namespace App\Models;

interface WeatherApiInterface {
    public function fetchWeather($cityName);
}

abstract class WeatherApi implements WeatherApiInterface {
    protected $apiKey;
    protected $url;
    protected $cityNameEscaped;

    protected function encodeCityName($cityName) {
        return urlencode($cityName);
    }
}
?>
