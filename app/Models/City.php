<?php
namespace App\Models;

use App\Models\BaseModel;
use App\Core\Database;
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


    // ===================
    // === Constructor ===
    // ===================

    /**
     * Constructor
     * @param int $id
     * @param string $name
     */
    public function __construct($id, $name) {
        parent::__construct($id);
        $this->name = $name;
    }


    // ===============
    // === Getters ===
    // ===============

    public function getName() {
        return $this->name;
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
     * Retrieve the last history record for this city.
     * 
     * @return History|null
     */
    public function getLastHistory() {
        return History::findLastById($this->getId());
    }


    /**
     * Retrieve all cities from the database.
     * @throws PDOException
     * @return City[]
     */
    public static function findAll() {
        $database = Database::getInstance()->connect();
        $PDOStatement = $database->query("SELECT * FROM cities");
        if ($PDOStatement === false) {
            throw new PDOException("Failed to retrieve cities from database.");
        }
        $citiesData = $PDOStatement->fetchAll();
        $cities = [];
        foreach ($citiesData as $key => $cityData) {
            $cities[] = City::transformDataToCity($cityData);
        }
        return $cities;
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
        if (!isset($data['id'], $data['name'])) {
            throw new InvalidArgumentException("Missing required data fields to transform to City object.");
        }
        return new City(
            $data['id'],
            $data['name']
        );
    }
}
