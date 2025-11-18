<?php
namespace App\controllers;

use App\controllers\AbstractViewController;
use App\models\City;
use App\models\History;
use PDOException;
use InvalidArgumentException;
use RuntimeException;

/**
* Controller for the main page: Listing all the cities
*/
class CitiesListController extends AbstractViewController {


	// =================
	// === Variables ===
	// =================

	/* @var string */
	private $method;


	// ===================
	// === Constructor ===
	// ===================

	/**
	* Constructor.
	* @param string $method
	*/
	public function __construct($viewType, $method = 'post') {
		parent::__construct($viewType);
		$this->method = $method;
	}

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
				'method' => $this->method,
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
