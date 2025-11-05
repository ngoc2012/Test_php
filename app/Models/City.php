<?php
namespace App\Models;

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

    /* @var History weather data */
    private $weather;
    
    /**
     * Constructor
     * @param int $id
     * @param string $name
     */
    public function __construct($id, $name) {
        $this->id = $id;
        $this->name = $name;
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

    public function getWeather() {
        return $this->weather;
    }

    // ===============
    // === SETTERS ===
    // ===============

    public function setWeather($weather) {
        $this->weather = $weather;
    }
    public function getHistory() {
        return History::findAllById($this->id);
    }

    // ===========================
    // === DATA ACCESS METHODS ===
    // ===========================

    /**
     * Retrieve all cities from the database.
     * 
     * @throws \Exception
     * @return City[]
     */
    public static function findAll() {
        try {
            $database = Database::getInstance()->connect();
            $PDOStatement = $database->query("SELECT * FROM cities");
            $citiesData = $PDOStatement->fetchAll();
            $cities = [];
            foreach ($citiesData as $key => $cityData) {
                $cities[] = new City(
                    $cityData['id'],
                    $cityData['name']
                );
            }
            return $cities;
        } catch (PDOException $e) {
            (new ErrorController('smarty'))->error($e->getMessage());
            exit;
        }
    }
}
