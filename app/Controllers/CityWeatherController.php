<?php
namespace App\Controllers;

use App\Controllers\AbstractViewController;
use App\Services\WeatherService;
use App\Models\City;

/**
 * Controller for the city weather page
 */
class CityWeatherController extends AbstractViewController {

    /* @var City */
    private $city;
    /* @var string */
    private $apiName;

    /**
     * Constructor for the CityWeatherController.
     * @param string $viewType
     * @param City $city
     * @param string $apiName
     */
    public function __construct($viewType, City $city, $apiName) {
        parent::__construct($viewType);
        $this->city = $city;
        $this->apiName = $apiName;
    }

    /**
     * Get the weather data for a specific city and display it.
     * 
     * @return void
     */
    public function init() {
        WeatherService::getData($this->city, $this->apiName);
        $this->getView()->render('city_weather.tpl', ['city' => $this->city, 'lastHistory' => $this->city->getLastHistory()]);
    }
}