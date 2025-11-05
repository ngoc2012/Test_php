<?php
namespace App\Models;

require_once __DIR__ . '/WeatherApi.php';
require_once __DIR__ . '/FreeWeatherApi.php';
require_once __DIR__ . '/OpenWeatherApi.php';
require_once __DIR__ . '/../Core/Database.php';
require_once __DIR__ . '/../Controllers/ErrorController.php';

use App\Controllers\ErrorController;
use App\Core\Database;
use PDOException;

/**
 * City model class
 */
class City {

    /* @var int city id */
    private $id;

    /* @var string city name */
    private $name;

    /* @var string country name */
    private $country;

    /* @var float latitude */
    private $latitude;

    /* @var float longitude */
    private $longitude;
    
    /**
     * Constructor
     * @param int $id
     * @param string $name
     * @param string $country
     * @param float $latitude
     * @param float $longitude
     */
    public function __construct($id, $name, $country, $latitude, $longitude) {
        $this->id = $id;
        $this->name = $name;
        $this->country = $country;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }


    // ===============
    // === GETTERS ===
    // ===============

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getCountry() {
        return $this->country;
    }

    public function getLatitude() {
        return $this->latitude;
    }

    public function getLongitude() {
        return $this->longitude;
    }


    // ===========================
    // === DATA ACCESS METHODS ===
    // ===========================

    /**
     * Retrieve all cities from the database.
     * 
     * @throws \Exception
     * @return array{id:int, name:string, country:string, latitude:float, longitude:float} List of City objects
     */
    public static function findAll() {
        try {
            $db = Database::getInstance()->connect();
            $results = $db->query("SELECT * FROM cities");
            $cities = $results->fetchAll();
            return $cities;
        } catch (PDOException $e) {
            (new ErrorController('smarty'))->error($e->getMessage());
            exit;
        }
    }
}
