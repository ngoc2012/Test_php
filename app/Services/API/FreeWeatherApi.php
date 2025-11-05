<?php
namespace App\Services\API;

use App\Models\City;
use App\Models\History;
use App\Services\API\WeatherApi;
use Config\AppConfig;

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
     * @param City $city
     * @throws \Exception
     */
    public function fetchWeather($city) {
        $cityNameEscaped = $this->encodeCityName($city->getName());
        $url = $this->getUrl($cityNameEscaped);
        $response = file_get_contents($url);

        if (!$response) {
            throw new \Exception("Failed to fetch weather data from FreeWeather API.");
        }
        $data = json_decode($response, true);
        $new_history = new History(
            $city->getId(),
            "FreeWeatherApi",
            $data['current']['temp_c'],
            $data['current']['humidity'],
            ""
        );
        $city->setWeather($new_history);
        History::save($new_history);
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