<?php
namespace App\Controllers;

use App\Models\City;
use App\Controllers\CityWeatherController;
use App\Controllers\CityListController;
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
            $controller = new CityWeatherController('smarty', $city, trim($_GET['api']));
        } else {
            $controller = new CityListController('raintpl');
        }
        try {
            $controller->init();
        } catch (RuntimeException $e) {
            (new ErrorController('smarty'))->init($e->getMessage());
            exit;
        }
    }   
}
