<?php
namespace App\Controllers;

use App\Models\City;
use App\Controllers\CityWeatherController;
use App\Controllers\CitiesListController;
use RuntimeException; 

/**
 * Main page: entry point for all pages
 */
class MainController {
    

    // =========================
    // === Public Methods ======
    // =========================
    
    /**
     * Main entry point of the application.
     */
    public static function index() {
        if (isset($_GET["name"])) {
            $city = City::transformDataToCity($_GET);
            if (isset($_GET['id'])) {
                $city_found = City::findById(intval($_GET['id']));
                if ($city_found->getName() !== $city->getName()) {
                    (new ErrorController('smarty'))->init("City ID and name do not match.");
                    exit;
                }
            }
            $controller = new CityWeatherController('smarty', $city, trim($_GET['api']));
        } else {
            $controller = new CitiesListController('smarty');
        }
        try {
            $controller->init();
        } catch (RuntimeException $e) {
            (new ErrorController('smarty'))->init($e->getMessage());
            exit;
        }
    }   
}
