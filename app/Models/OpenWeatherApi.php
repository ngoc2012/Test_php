<?php
namespace App\Models;

require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/WeatherApi.php';

use App\Models\WeatherApi;

class OpenWeatherApi extends WeatherApi
{

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

    private function getUrl($cityNameEscaped)
    {
        return $this->baseUrl . "?q={$cityNameEscaped}&units=metric&lang=en&appid={$this->apiKey}";
    }

    /**
     * Get weather data for a specified city.
     * @param string $city
     * @throws \Exception
     * @return array{humidity: float, temperature: float}
     */
    public function fetchWeather($city)
    {
        $cityNameEscaped = $this->encodeCityName($city);
        $url = $this->getUrl($cityNameEscaped);
        error_log("Fetching weather data from URL: " . $url);
        $response = file_get_contents($url);

        if (!$response) {
            throw new \Exception("Failed to fetch weather data.");
        }
        $data = json_decode($response, true);
        return [
            'temperature' => $data['main']['temp'],
            'humidity' => $data['main']['humidity'],
        ];
    }
}
?>