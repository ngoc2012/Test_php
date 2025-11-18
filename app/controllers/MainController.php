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
	public static function index($method) {
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
			$controller = new CitiesListController('raintpl',$method === $_POST ? 'POST' : 'GET');
		}
		try {
			$controller->init();
		} catch (RuntimeException $e) {
			(new ErrorController('smarty'))->init($e->getMessage());
			exit;
		}
	}
}
