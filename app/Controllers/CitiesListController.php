<?php
namespace App\Controllers;

use App\Controllers\AbstractViewController;
use App\Models\City;
use App\Models\History;
use PDOException;
use InvalidArgumentException;
use RuntimeException;

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
			$apiName = 'OpenWeatherMap';
			if (count($cities) === 0) {
				$lastCity = City::save('Paris');
			} else {
				try {
					$lastHistory = History::findLast();
					$apiName = $lastHistory->getApi();
					$lastCityId = $lastHistory->getCityId();
				} catch (InvalidArgumentException $e) {
					$lastCityId = $cities[0]->getId();
				}
				$lastCity = City::findById($lastCityId);
			}
		} catch (PDOException $e) {
			(new ErrorController('smarty'))->init($e->getMessage());
			exit;
		} catch (InvalidArgumentException $e) {
			(new ErrorController('smarty'))->init($e->getMessage());
			exit;
		}
		$history = $this->getData($lastCity, $apiName);
		try {
			$this->getView()->render('theme.tpl', "citiesList", [
				'cities' => $cities,
				'city' => $lastCity,
				'history' => $history
			]);
		} catch (RuntimeException $e) {
			(new ErrorController('smarty'))->init($e->getMessage());
			exit;
		}
	}
}
