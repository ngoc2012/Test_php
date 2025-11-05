<?php
namespace App\Controllers;

use App\Controllers\ViewController;
use App\Models\WeatherService;
use App\Models\History;

/**
 * Controller for the city weather page
 */
class CityWeatherController extends ViewController {

    /**
     * Main method to handle the city weather request.
     * @param int|null $cityId
     * @param string|null $cityName
     * @param string|null $api
     * @return void
     */
    public function index($cityId = 0, $cityName = null, $api = null) {
        $weatherData = WeatherService::getData($cityId, $cityName, $api);
        History::create($weatherData);
        $history = History::findAllById($cityId);
        $this->render('city_weather.tpl', [
            'history' => $history,
            'city' => $cityName,
            'weather' => $weatherData->toArray()
        ]);
    }
}