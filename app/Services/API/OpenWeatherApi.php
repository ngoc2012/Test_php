<?php
namespace App\Services\API;

use App\Models\City;
use App\Models\History;
use App\Services\API\AbstractWeatherApi;
use Config\AppConfig;
use Exception;

/**
 * OpenWeatherApi class to interact with the OpenWeather API
 */
class OpenWeatherApi extends AbstractWeatherApi {

    /**
     * Constructor allows overriding the API key and base URL.
     *
     * @param string|null $apiKey
     * @param string|null $baseUrl
     */
    public function __construct($apiKey = null, $baseUrl = null) {
        $this->apiName = "OpenWeatherApi";
        $this->apiKey  = $apiKey ?: AppConfig::OPENWEATHER_API_KEY;
        $this->baseUrl = $baseUrl ?: AppConfig::OPENWEATHER_BASE_URL;
    }

    /**
     * Get weather data for a specified city.
     * @param City $city
     * @return History
     * @throws Exception
     */
    public function fetchWeather($city) {
        $cityNameEscaped = $this->encodeCityName($city->getName());
        $url = $this->getUrl($cityNameEscaped);
        $response = file_get_contents($url);

        if (!$response) {
            throw new Exception("Failed to fetch weather data from OpenWeather API.");
        }
        $data = json_decode($response, true);
        $temperature = $data['main']['temp'];
        $humidity = $data['main']['humidity'];
        try {
            $this->dataCheck($temperature, $humidity);
        } catch (Exception $e) {
            throw new Exception("Weather data validation failed: " . $e->getMessage());
        }
        return new History(
            $city->getId(),
            $this->apiName,
            $temperature,
            $humidity,
            date('Y-m-d H:i:s')
        );
    }

    /**
     * Get the API request URL for a specific city.
     * @param string $cityNameEscaped
     * @return string
     */
    private function getUrl($cityNameEscaped) {
        return $this->baseUrl . "?q={$cityNameEscaped}&units=metric&lang=en&appid={$this->apiKey}";
    }
}
