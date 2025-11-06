<?php
namespace App\Controllers;

use App\Controllers\CityWeatherController;
use App\Controllers\CityListController; 

class MainController {
    
    /**
     * Main entry point of the application.
     */
    public static function index() {
        if (isset($_POST["id"]) && isset($_POST["name"]) && isset($_POST["api"])) {
            $controller = new CityWeatherController('smarty');
            $controller->index();
        } else {
            $controller = new CityListController('raintpl');
            $controller->index();
        }
    }
}
