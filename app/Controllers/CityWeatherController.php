<?php
namespace App\Controllers;

use App\Controllers\ViewController;
use App\Services\WeatherService;
use App\Models\City;
use App\Models\History;

/**
 * Controller for the city weather page
 */
class CityWeatherController extends ViewController {

    /**
     * Get the weather data for a specific city and display it.
     * 
     * @return void
     */
    public function index() {


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
        $_POST['id'] = (int) $_POST['id'];
        if ($_POST['id'] <= 0) {
            (new ErrorController())->index('Invalid City ID.');
            exit;
        }
        $city = City::transformDataToCity($_POST);
        WeatherService::getData($city, trim($_POST['api']));
        $this->getView()->render('city_weather.tpl', ['city' => $city, 'lastHistory' => $city->getLastHistory()]);
    }
}