<?php
namespace App\Controllers;

require_once __DIR__ . '/../Controllers/ViewController.php';
require_once __DIR__ . '/../Models/History.php';
require_once __DIR__ . '/../Models/Weather.php';

use App\Controllers\ViewController;
use App\Models\Weather;
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
        $weatherData = Weather::getData($cityId, $cityName, $api);
        History::create($weatherData);
        $history = History::findAllById($cityId);
        $this->render('city_weather.tpl', [
            'history' => $history,
            'city' => $cityName,
            'weather' => $weatherData->toArray()
        ]);
    }
}