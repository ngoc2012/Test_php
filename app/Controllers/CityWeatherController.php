<?php
namespace App\Controllers;

use App\Controllers\AbstractViewController;
use App\Models\City;
use RuntimeException;

/**
* Controller for the city weather page
*/
class CityWeatherController extends AbstractViewController {
	
	
	// =================
	// === Variables ===
	// =================
	
	/* @var City */
	private $city;
	/* @var string */
	private $apiName;
	
	
	// ===================
	// === Constructor ===
	// ===================
	
	/**
	* Constructor for the CityWeatherController.
	* @param string $viewType
	* @param City $city
	* @param string $apiName
	*/
	public function __construct($viewType, City $city, $apiName) {
		parent::__construct($viewType);
		$this->city = $city;
		$this->apiName = $apiName;
	}
	
	
	// ======================
	// === Public Methods ===
	// ======================
	
	/**
	* Get the weather data for a specific city and display it.
	* 
	* @return void
	*/
	public function init() {
		$this->getData($this->city, $this->apiName);
		$histories = $this->city->getHistories();
		if (count($histories) == 0) {
			(new ErrorController('smarty'))->init('No weather history found for this city.');
			exit;
		}
		try {
			$this->getView()->render('theme.tpl', 'cityWeather', [
				'histories' => $histories,
				'city' => $this->city,
				'history' => $histories[0]
			]);
		} catch (RuntimeException $e) {
			(new ErrorController('smarty'))->init($e->getMessage());
			exit;
		}
	}
}