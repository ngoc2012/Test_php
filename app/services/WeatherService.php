<?php
namespace App\services;

use App\models\City;
use App\models\History;
use App\services\api\FreeWeatherApi;
use App\services\api\OpenWeatherApi;
use InvalidArgumentException;
/**
* WeatherService class to fetch weather data
*/
class WeatherService {


	// ======================
	// === Public methods ===
	// ======================

	/**
	* Fetch weather metrics for a given city using the specified API.
	*
	* @param City $city The City object.
	* @param string|null $apiName The name of the API to use (optional).
	* @return History
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
			list($temperature, $humidity) = $api->fetchWeather($city);
			if (!$city->getId()) {
				try {
					$cityFound = City::findByName($city->getName());
					$city->setId($cityFound->getId());
				} catch (InvalidArgumentException $e) {
					$newCity = City::save($city->getName());
					$city->setId($newCity->getId());
				}
			}
			$history = History::transformDataToHistory([
				"cityId" => $city->getId(),
				"api" => $api->getApiName(),
				"temperature" => $temperature,
				"humidity" => $humidity
			]);
			History::save($history);
			return $history;
		}
	}
