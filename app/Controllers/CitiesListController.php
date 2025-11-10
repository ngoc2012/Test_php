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
            $cities = City::findAll();
            $lastHistory = History::findLast();
            $lastCity = City::findById($lastHistory->getCityId());
        } catch (PDOException $e) {
            (new ErrorController('smarty'))->init($e->getMessage());
            exit;
        } catch (InvalidArgumentException $e) {
            (new ErrorController('smarty'))->init($e->getMessage());
            exit;
        }
        $history = $this->getData($lastCity, $lastHistory->getApi());
        $weatherPanel = $this->getView()->fetch('weatherPanel.tpl', [
            'city' => $lastCity,
            'history' => $history
        ]);
        $container = $this->getView()->fetch('citiesList.tpl', [
            'cities' => $cities,
            'weatherPanel' => $weatherPanel
        ]);
        $this->getView()->renderMain('index.tpl', $container);
    }
}
