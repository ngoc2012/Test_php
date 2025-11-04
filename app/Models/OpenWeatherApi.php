<?php
namespace App\Models;
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/WeatherApi.php';

class OpenWeatherApi extends WeatherApi
{
    private $apiKey;
    private $baseUrl;

    /**
     * Constructor allows overriding the API key and base URL.
     * Useful for tests or different environments.
     *
     * @param string|null $apiKey
     * @param string|null $baseUrl
     */
    public function __construct($apiKey = null, $baseUrl = null)
    {
        $this->apiKey  = $apiKey ?: OPENWEATHER_API_KEY;
        $this->baseUrl = $baseUrl ?: OPENWEATHER_BASE_URL;
    }

    private function getUrl($city_name_escaped)
    {
        return $this->baseUrl . "?q={$city_name_escaped}&units=metric&lang=en&appid={$this->apiKey}";
    }

    public function fetchWeather($city)
    {
        $city_name_escaped = $this->encodeCityName($city);
        $url = $this->getUrl($city_name_escaped);

        $response = file_get_contents($url);

        if (!$response) {
            throw new \Exception("Failed to fetch weather data.");
        }

        return json_decode($response, true);
    }
}
?>