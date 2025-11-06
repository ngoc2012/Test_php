<?php
namespace App\Models;

use App\Controllers\ErrorController;
use App\Core\Database;
use PDOException;
use Exception;

/**
 * City model class
 */
class City {

    /* @var int city id */
    private $id;

    /* @var string city name */
    private $name;

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
    

    // ===========================
    // === DATA ACCESS METHODS ===
    // ===========================

    /**
     * Retrieve all history records for this city.
     * 
     * @throws Exception
     * @return History[]
     */
    public function getHistory() {
        return History::findAllById($this->id);
    }

    /**
     * Retrieve the last history record for this city.
     * 
     * @throws Exception
     * @return History|null
     */
    public function getLastHistory() {
        return History::findLastById($this->id);
    }


    /**
     * Retrieve all cities from the database.
     * 
     * @throws Exception
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
            (new ErrorController('smarty'))->index($e->getMessage());
            exit;
        }
    }
}
