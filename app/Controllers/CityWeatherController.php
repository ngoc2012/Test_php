<?php
namespace App\Controllers;

use App\Controllers\AbstractViewController;
use App\Models\City;

/**
 * Controller for the city weather page
 */
class CityWeatherController extends AbstractViewController {


    // =================
    // === Variables ===
    // =================

    /* @var City */
    private $city;
    /* @var string */
    private $apiName;


    // ===================
    // === Constructor ===
    // ===================
    
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

    
    // ======================
    // === Public Methods ===
    // ======================

    /**
     * Get the weather data for a specific city and display it.
     * 
     * @return void
     */
    public function init() {
        $this->getData($this->city, $this->apiName);
        $history = $this->city->getHistory();
        if (count($history) == 0) {
            (new ErrorController('smarty'))->init('No weather history found for this city.');
            exit;
        }
        City::updateVisitedAt($this->city->getId());
        $weather_panel = $this->getView()->fetch('weather_panel.tpl', ['city' => $this->city, 'history' => $history[0]]);
        $container = $this->getView()->fetch('city_weather.tpl', ['history' => $history, 'weather_panel' => $weather_panel]);
        $this->getView()->render_main('index.tpl', $container);
    }
}