<?php
namespace App\Controllers;

use App\Controllers\AbstractViewController;
use App\Models\City;
use PDOException;

/**
 * Controller for the main page: Listing all the cities
 */
class CityListController extends AbstractViewController {

    
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
        } catch (PDOException $e) {
            (new ErrorController('smarty'))->init($e->getMessage());
            exit;
        }
        $last_city = $cities[0];
        // error_log("Last city: " . $last_city->getName() . ", " . $last_city->getId());
        $history = $this->getData($last_city, null);
        $weather_panel = $this->getView()->fetch('weather_panel.tpl', [
            'city' => $last_city,
            'history' => $history
        ]);
        $container = $this->getView()->fetch('list.tpl', [
            'cities' => $cities,
            'weather_panel' => $weather_panel
        ]);
        $this->getView()->render_main('index.tpl', $container);
    }
}
