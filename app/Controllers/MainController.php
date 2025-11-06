<?php
namespace App\Controllers;

use App\Models\City;
use App\Controllers\CityWeatherController;
use App\Controllers\CityListController; 

class MainController {
    

    // =========================
    // === Public Methods ======
    // =========================
    
    /**
     * Main entry point of the application.
     */
    public static function index() {
        if (isset($_POST["id"]) && isset($_POST["name"]) && isset($_POST["api"])) {

            
            // ================================
            // === Validate POST parameters ===
            // ================================

            if (!isset($_POST['id'])) {
                (new ErrorController())->init('Missing city ID.');
                exit;
            }

            if (!isset($_POST['name'])) {
                (new ErrorController())->init('Missing city data.');
                exit;
            }

            if (!isset($_POST['api'])) {
                (new ErrorController())->init('Missing API data.');
                exit;
            }

            // Convert ID to integer
            $_POST['id'] = (int) $_POST['id'];
            if ($_POST['id'] <= 0) {
                (new ErrorController())->init('Invalid City ID.');
                exit;
            }


            // ===============================
            // === Send data to controller ===
            // ===============================

            $city = City::transformDataToCity($_POST);
            $controller = new CityWeatherController('smarty', $city, trim($_POST['api']));
            $controller->init();
        } else {
            $controller = new CityListController('raintpl');
            $controller->init();
        }
    }
}
