<?php

require_once __DIR__ . '/WeatherApi.php';
require_once __DIR__ . '/WeatherMetrics.php';

class Weather {
    private $city;
    private $metrics;

    public function __construct($city) {
        $this->city = $city;
    }

    public function getCity() {
        return $this->city;
    }

    public function getMetrics(WeatherApi $api = null) {
        if ($api === null) {
            $api = new OpenWeatherApi();
        }
        $weatherData = $api->fetchWeather($this->city);
        $this->metrics = new WeatherMetrics(
            $weatherData['temp'],
            $weatherData['humidity']
        );
        return json_encode($this->metrics);
    }
}
?>
