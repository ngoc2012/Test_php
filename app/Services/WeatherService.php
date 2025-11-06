<?php
namespace App\Services;

use App\Models\City;
use App\Models\History;
use App\Services\API\FreeWeatherApi;
use App\Services\API\OpenWeatherApi;
use App\Controllers\ErrorController;
use Exception;
use UnexpectedValueException;

/**
 * WeatherService class to fetch weather data
 */
class WeatherService {

    /**
     * Fetch weather metrics for a given city using the specified API.
     *
     * @param City $city The City object.
     * @param string|null $apiName The name of the API to use (optional).
     */
    public static function getData($city, $apiName = null) {
        switch ($apiName) {
            case 'FreeWeatherApi':
                $api = new FreeWeatherApi();
                break;
            default:
                $api = new OpenWeatherApi();
                break;
        }
        try {
            list($temperature, $humidity) = $api->fetchWeather($city);
            self::dataCheck($temperature, $humidity);
        } catch (Exception $e) {
            (new ErrorController('smarty'))->index($e->getMessage());
            exit;
        }
        $history = new History(
            $city->getId(),
            $apiName,
            $temperature,
            $humidity,
            date('Y-m-d H:i:s')
        );
        History::save($history);
    }

    /**
     * Validate the API response data.
     * @param float $temperature
     * @param float $humidity
     * @throws UnexpectedValueException
     */
    private static function dataCheck($temperature, $humidity) {
        if (!is_numeric($temperature)) {
            throw new UnexpectedValueException("Temperature value is not numeric.");
        }
        if (!is_numeric($humidity)) {
            throw new UnexpectedValueException("Humidity value is not numeric.");
        }
        if ($temperature < -100 || $temperature > 100) {
            throw new UnexpectedValueException("Temperature value is invalid.");
        }
        if ($humidity < 0 || $humidity > 100) {
            throw new UnexpectedValueException("Humidity value is invalid.");
        }
    }
}
