<?php
namespace App\Controllers;

require_once __DIR__ . '/../Controllers/ViewController.php';
require_once __DIR__ . '/../Models/History.php';
require_once __DIR__ . '/../Models/City.php';

use App\Controllers\ViewController;
use App\Controllers\ErrorController;
use App\Models\City;
use App\Models\History;

class CityWeatherController extends ViewController {
    /**
     * CityWeatherController constructor.
     * @param string $viewType smarty|raintpl
     * @return void
     */
    public function __construct($viewType = 'smarty') {
        parent::__construct($viewType);
    }

    /**
     * Main method to handle the city weather request.
     * @param int|null $cityId
     * @param string|null $cityName
     * @param string|null $api
     * @return void
     */
    public function index($cityId = 0, $cityName = null, $api = null) {
        $weather = City::getWeather($cityName, $api);
        History::create($cityId, $weather);
        $history = History::findAllById($cityId);
        $this->render('city_weather.tpl', ['history' => $history, 'city' => $cityName, 'weather' => $weather]);
    }
}