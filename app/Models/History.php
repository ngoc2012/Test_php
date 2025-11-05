<?php
namespace App\Models;

use App\Controllers\ErrorController;
use App\Core\Database;
use PDOException;

/**
 * History model class with history records of weather data
 */
class History {

    /* @var int city id */
    private $cityId;

    /* @var string API used */
    private $api;

    /* @var float temperature */
    private $temperature;

    /* @var float humidity */
    private $humidity;

    /**
     * Constructor
     * @param int $cityId
     * @param string $api
     * @param float $temperature
     * @param float $humidity
     */
    public function __construct($cityId, $api, $temperature, $humidity) {
        $this->id = 0;
        $this->cityId = $cityId;
        $this->api = $api;
        $this->temperature = $temperature;
        $this->humidity = $humidity;
    }


    // ===============
    // === GETTERS ===
    // ===============

    public function getCityId() {
        return $this->cityId;
    }
    public function getApi() {
        return $this->api;
    }
    public function getTemperature() {
        return $this->temperature;
    }
    public function getHumidity() {
        return $this->humidity;
    }

    public function toArray() {
        return [
            'cityId'      => $this->cityId,
            'api'         => $this->api,
            'temperature' => $this->temperature,
            'humidity'    => $this->humidity
        ];
    }


    // ===========================
    // === DATA ACCESS METHODS ===
    // ===========================

    /**
     * Find all the histories of a city by its id
     * @param int $id
     * @return array{id: int, cityId: int, api: string, temperature: float, humidity: float, createdAt: string} associative array of history records
     */
    public static function findAllById($id) {
        try {
            $database = Database::getInstance()->connect();
            $PDOStatement = $database->prepare("SELECT * FROM history WHERE cityId = :cityId ORDER BY created_at DESC LIMIT 10");
            $PDOStatement->execute([':cityId' => $id]);
            $history = $PDOStatement->fetchAll();
            return $history;
        } catch (PDOException $e) {
            (new ErrorController('smarty'))->error($e->getMessage());
            exit;
        }
    }

    /**
     * Create a new history record on the database
     * @param History $weatherData
     * @return void
     */
    public static function create($weatherData) {
        try {
            $database = Database::getInstance()->connect();
            $PDOStatement = $database->prepare("
                INSERT INTO history (cityId, api, temperature, humidity, created_at)
                VALUES (:cityId, :api, :temperature, :humidity, NOW())
            ");
            $PDOStatement->execute([
                ':cityId'      => $weatherData->getCityId(),
                ':api'         => $weatherData->getApi(),
                ':temperature' => $weatherData->getTemperature(),
                ':humidity'    => $weatherData->getHumidity()
            ]);
        } catch (PDOException $e) {
            (new ErrorController('smarty'))->error($e->getMessage());
            exit;
        }
    }
}
