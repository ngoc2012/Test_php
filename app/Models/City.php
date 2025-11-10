<?php
namespace App\Models;

use App\Models\BaseModel;
use App\Core\Database;
use App\Services\API\OpenWeatherApi;
use PDOException;
use Exception;
use InvalidArgumentException;

/**
 * City model class
 */
class City extends BaseModel {


    // =================
    // === Variables ===
    // =================

    /* @var string city name */
    private $name;
    /* @var string */
    private $visitedAt;


    // ===================
    // === Constructor ===
    // ===================

    /**
     * Constructor
     * @param int $id
     * @param string $name
     */
    public function __construct($id = null, $name) {
        parent::__construct($id);
        $this->name = $name;
    }


    // ======================
    // === Public methods ===
    // ======================

    public function getName() {
        return $this->name;
    }

    /**
     * Encode the city name for URL usage.
     *
     * @return string The URL-encoded city name.
     */
    public function encodeCityName() {
        return urlencode($this->name);
    }


    // ===========================
    // === Data access methods ===
    // ===========================

    /**
     * Retrieve all history records for this city.
     * 
     * @throws Exception
     * @return History[]
     */
    public function getHistory() {
        return History::findAllById($this->getId());
    }

    /**
     * Retrieve a city by its ID.
     * @param int $id
     * @throws PDOException
     * @return City|null
     */
    public static function findById($id) {
        $database = Database::getInstance()->connect();
        $PDOStatement = $database->query("SELECT * FROM cities WHERE id = " . $id );
        if (!$PDOStatement) {
            throw new PDOException("Failed to retrieve city from database.");
        }
        $cityData = $PDOStatement->fetch();
        if (!$cityData) {
            return null;
        }
        return City::transformDataToCity($cityData);
    }

    /**
     * Retrieve a city by its name.
     * @param string $name
     * @throws PDOException
     * @return City|null
     */
    public static function findByName($name) {
        $database = Database::getInstance()->connect();
        $PDOStatement = $database->prepare("SELECT * FROM cities WHERE name = :name");
        $PDOStatement->bindParam(':name', $name, \PDO::PARAM_STR);
        if (!$PDOStatement->execute()) {
            throw new PDOException("Failed to retrieve city from database.");
        }
        $cityData = $PDOStatement->fetch();
        if (!$cityData) {
            return null;
        }
        return City::transformDataToCity($cityData);
    }

    /**
     * Retrieve all cities from the database.
     * @throws PDOException
     * @return City[]
     */
    public static function findAll() {
        $database = Database::getInstance()->connect();
        $PDOStatement = $database->query("SELECT * FROM cities ORDER BY visitedAt DESC LIMIT 10");
        if (!$PDOStatement) {
            throw new PDOException("Failed to retrieve cities from database.");
        }
        $citiesData = $PDOStatement->fetchAll();
        $cities = [];
        foreach ($citiesData as &$cityData) {
            $cities[] = City::transformDataToCity($cityData);
        }
        return $cities;
    }

    /**
     * Save the city to the database.
     * @param string $cityName
     * @throws PDOException
     * @return City
     */
    public static function save($cityName) {
        $database = Database::getInstance()->connect();
        $PDOStatement = $database->query("INSERT INTO cities (name, visitedAt) VALUES (" . $database->quote($cityName) . ", NOW())");
        if (!$PDOStatement) {
            throw new PDOException("Failed to save city to database.");
        }
        $cityId = $database->lastInsertId();
        return self::transformDataToCity([
            "id"=> $cityId,
            "name"=> $cityName,
        ]);
    }

    /**
     * Update the city's visitedAt timestamp to the current time.
     * @param int $id
     * @throws PDOException
     * @return void
     */
    public static function updateVisitedAt($id) {
        $database = Database::getInstance()->connect();
        $PDOStatement = $database->query("UPDATE cities SET visitedAt = NOW() WHERE id = " . $id);
        if (!$PDOStatement) {
            throw new PDOException("Failed to update city's visitedAt in database.");
        }
    }

    // ===========
    // === DTO ===
    // ===========

    /**
     * Transform data array to City object
     * @param array $data
     * @throws \InvalidArgumentException
     * @return City
     */
    public static function transformDataToCity($data) {
        if (!is_array($data)) {
            throw new InvalidArgumentException("Data must be an array to transform to City object.");
        }
        if (!isset($data['name'])) {
            throw new InvalidArgumentException("Missing city name to transform to City object.");
        }
        if (isset($data['id']) && !is_numeric($data['id'])) {
            throw new InvalidArgumentException("City ID must be numeric.");
        }
        return new City(
            isset($data['id']) ? (int) $data['id'] : null,
            $data['name']
        );
    }
}
