<?php
namespace App\controllers;

use App\models\City;
use App\controllers\CityWeatherController;
use App\controllers\CitiesListController;
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
				$cityFound = City::findById(intval($_GET['id']));
				if ($cityFound->getName() !== $city->getName()) {
					(new ErrorController('smarty'))->init("City ID and name do not match.");
					exit;
				}
			}
			$controller = new CityWeatherController('smarty', $city, trim($_GET['api']));
		} else {
			$controller = new CitiesListController('raintpl');
		}
		try {
			$controller->init();
		} catch (RuntimeException $e) {
			(new ErrorController('smarty'))->init($e->getMessage());
			exit;
		}
	}   
}
