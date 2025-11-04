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

class OpenWeatherApi extends WeatherApi {
    public function __construct() {
        $this->apiKey = '6bd83c8ba20d3606bd49cef93d45f943';
    }

    private function getUrl($city_name_escaped) {
        $url = "https://api.openweathermap.org/data/2.5/weather?q={$city_name_escaped}&units=metric&lang=en&appid={$this->apiKey}";
        return $url;
    }

    public function fetchWeather($city) {
        $city_name_escaped = $this->encodeCityName($city);
        $url = $this->getUrl($city_name_escaped);
        $response = file_get_contents($url);
        if (!$response) {
            throw new Exception("Failed to fetch weather data.");
        }
        return json_decode($response, true);
    }
}

class MockWeatherApi implements WeatherApiInterface {
    public function fetchWeather() {
        // Fake data for tests
        return ['temp' => 18, 'city' => 'Test City'];
    }
}
?>
