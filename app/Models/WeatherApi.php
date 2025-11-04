<?php

interface WeatherApiInterface {
    public function fetchWeather();
}

class WeatherApi implements WeatherApiInterface {
    protected $apiKey;
    protected $url;
    protected $city_name_escaped;

    private function encodeCityName($city) {
        return urlencode($city);
    }
}

class MockWeatherApi implements WeatherApiInterface {
    public function fetchWeather() {
        // Fake data for tests
        return ['temp' => 18, 'city' => 'Test City'];
    }
}
?>
