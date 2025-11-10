<?php
namespace App\Controllers;

use App\Controllers\AbstractViewController;
use App\Services\WeatherService;
use App\Models\City;
use PDOException;
use RuntimeException;
use InvalidArgumentException;
use Exception;

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
        try {
            WeatherService::getData($this->city, $this->apiName);
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
        $history = $this->city->getHistory();
        if (count($history) == 0) {
            $city = City::findById($this->city->getId());
            if ($city->getName() != $this->city->getName()) {
                (new ErrorController('smarty'))->init('City name and ID mismatch.');
                exit;
            } else {
                (new ErrorController('smarty'))->init('No weather history found for this city.');
                exit;
            }
        }
        City::updateVisitedAt($this->city->getId());
        $this->getView()->render('city_weather.tpl', ['city' => $this->city, 'history' => $history]);
    }
}