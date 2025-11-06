<?php
namespace App\Controllers;

use App\Controllers\ViewController;
use App\Services\WeatherService;
use App\Models\City;

/**
 * Controller for the city weather page
 */
class CityWeatherController extends ViewController {

    /**
     * Get the weather data for a specific city and display it.
     * @param City|null $city
     * @param string|null $api
     * @return void
     */
    public function index($city = null, $api = null) {
        WeatherService::getData($city, $api);
        $this->getView()->render('city_weather.tpl', ['city' => $city]);
    }
}