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

        // ================================
        // === Validate POST parameters ===
        // ================================

        if (!isset($_POST['id'])) {
            (new ErrorController())->index('Missing city ID.');
            exit;
        }

        if (!isset($_POST['name'])) {
            (new ErrorController())->index('Missing city data.');
            exit;
        }

        if (!isset($_POST['api'])) {
            (new ErrorController())->index('Missing API data.');
            exit;
        }

        // Convert ID to integer
        $cityId = (int) $_POST['id'];
        if ($cityId <= 0) {
            (new ErrorController())->index('Invalid City ID.');
            exit;
        }
        $cityName = trim($_POST['name']);
        $city = new City($cityId, $cityName);
        $api = trim($_POST['api']);

        WeatherService::getData($city, $api);
        $this->getView()->render('city_weather.tpl', ['city' => $city]);
    }
}