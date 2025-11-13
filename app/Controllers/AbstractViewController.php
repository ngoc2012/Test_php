<?php
namespace App\Controllers;

use App\Views\ViewFactory;
use App\Views\ViewInterface;
use App\Services\WeatherService;
use App\Models\City;
use App\Models\History;
use PDOException;
use RuntimeException;
use InvalidArgumentException;
use Exception;

/**
* Base controller class to handle view rendering
*/
abstract class AbstractViewController {
	
	
	// =================
	// === Variables ===
	// =================
	
	/* @var ViewInterface renderer instance */
	private $view;
	
	
	// ===================
	// === Constructor ===
	// ===================
	
	/**
	* Constructor:
	* - Get the renderer instance from ViewFactory
	* @param string $viewType
	* @return void
	*/
	public function __construct($viewType = 'smarty') {
		$this->view = ViewFactory::create($viewType);
	}
	
	
	// ========================
	// === Abstract Methods ===
	// ========================
	
	/**
	* Abstract init method to be implemented by subclasses
	*/
	abstract public function init();
	
	
	// =========================
	// === Public Methods ======
	// =========================
	
	/**
	* View getter
	* @return ViewInterface
	*/
	public function getView() {
		return $this->view;
	}
	
	
	// =========================
	// === Protected Methods ===
	// =========================
	
	/**
	* Get weather data for a city using specified API.
	* @param City $city
	* @param string $apiName
	* @return History
	*/
	protected function getData($city, $apiName) {
		try {
			$lastHistory = WeatherService::getData($city, $apiName);
			return $lastHistory;
		} catch (RuntimeException $e) {
			(new ErrorController('smarty'))->init($e->getMessage());
			exit;
		} catch (InvalidArgumentException $e) {
			(new ErrorController('smarty'))->init($e->getMessage());
			exit;
		} catch (PDOException $e) {
			(new ErrorController('smarty'))->init($e->getMessage());
			exit;
		} catch (Exception $e) { // catch anything else
			(new ErrorController('smarty'))->init('Unexpected error: ' . $e->getMessage());
			exit;
		}
	}
	
}
