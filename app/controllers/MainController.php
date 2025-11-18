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
	* @param string $methodName The HTTP method name ('get' or 'post').
	*/
	public static function index($methodName) {
		if ($methodName == "get") {
			$method = $_GET;
		} else {
			$method = $_POST;
		}
		if (isset($method["name"])) {
			$city = City::transformDataToCity($method);
			if (isset($method['id'])) {
				$cityFound = City::findById(intval($method['id']));
				if ($cityFound->getName() !== $city->getName()) {
					(new ErrorController('smarty'))->init("City ID and name do not match.");
					exit;
				}
			}
			$controller = new CityWeatherController(
				'smarty',
				$city, trim($method['api'])
			);
		} else {
			$controller = new CitiesListController('raintpl',$methodName);
		}
		try {
			$controller->init();
		} catch (RuntimeException $e) {
			(new ErrorController('smarty'))->init($e->getMessage());
			exit;
		}
	}
}
