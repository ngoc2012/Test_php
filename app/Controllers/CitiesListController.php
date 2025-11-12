<?php
namespace App\Controllers;

use App\Controllers\AbstractViewController;
use App\Models\City;
use App\Models\History;
use PDOException;
use InvalidArgumentException;

/**
 * Controller for the main page: Listing all the cities
 */
class CitiesListController extends AbstractViewController {

    
    // =========================
    // === Public Methods ======
    // =========================
    
    /**
     * Display the list of cities.
     * @return void
     */
    public function init() {
        
        try {
            $cities = City::findLastVisitedCities(10);
            try {
                $lastHistory = History::findLast();
                $apiName = $lastHistory->getApi();
                $lastCityId = $lastHistory->getCityId();
            } catch (InvalidArgumentException $e) {
                $apiName = 'OpenWeatherMap';
                $lastCityId = $cities[0]->getId();
            }
            $lastCity = City::findById($lastCityId);
        } catch (PDOException $e) {
            (new ErrorController('smarty'))->init($e->getMessage());
            exit;
        } catch (InvalidArgumentException $e) {
            (new ErrorController('smarty'))->init($e->getMessage());
            exit;
        }
        $history = $this->getData($lastCity, $apiName);
        $container = $this->getView()->fetch('citiesList.tpl', [
            'cities' => $cities,
            'city' => $lastCity,
            'history' => $history
        ]);
        $this->getView()->renderMain('index.tpl', $container);
    }
}
