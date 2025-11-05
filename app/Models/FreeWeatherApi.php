<?php
namespace App\Models;

require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/WeatherApi.php';

use App\Models\WeatherApi;
use AppConfig;

/**
 * FreeWeatherApi class to interact with the FreeWeather API
 */
class FreeWeatherApi extends WeatherApi {

    /**
     * Constructor allows overriding the API key and base URL.
     * 
     * @param string|null $apiKey
     * @param string|null $baseUrl
     */
    public function __construct($apiKey = null, $baseUrl = null) {
        $this->apiKey  = $apiKey ?: AppConfig::FREEWEATHER_API_KEY;
        $this->baseUrl = $baseUrl ?: AppConfig::FREEWEATHER_BASE_URL;
    }

    /**
     * Get weather data for a specified city.
     * @param string $cityName
     * @throws \Exception
     * @return array{humidity: float, temperature: float}
     */
    public function fetchWeather($cityName) {
        $cityNameEscaped = $this->encodeCityName($cityName);
        $url = $this->getUrl($cityNameEscaped);
        $response = file_get_contents($url);

        if (!$response) {
            throw new \Exception("Failed to fetch weather data from FreeWeather API.");
        }
        $data = json_decode($response, true);
        return [
            'temperature' => $data['current']['temp_c'],
            'humidity' => $data['current']['humidity'],
        ];
    }

    /**
     * Construct the full API URL for fetching weather data.
     *
     * @param string $cityNameEscaped The URL-encoded city name.
     * @return string The complete API URL.
     */
    private function getUrl($cityNameEscaped) {
        return $this->baseUrl . "?key={$this->apiKey}&q={$cityNameEscaped}&aqi=no";
    }
}