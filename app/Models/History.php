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

    /* @var string created at */
    private $createdAt;

    /**
     * Constructor
     * @param int $cityId
     * @param string $api
     * @param float $temperature
     * @param float $humidity
     * @param string $createdAt
     */
    public function __construct($cityId, $api, $temperature, $humidity, $createdAt) {
        $this->cityId = $cityId;
        $this->api = $api;
        $this->temperature = $temperature;
        $this->humidity = $humidity;
        $this->createdAt = $createdAt;
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

    public function getCreatedAt() {
        return $this->createdAt;
    }


    // ===========================
    // === DATA ACCESS METHODS ===
    // ===========================

    /**
     * Find all the histories of a city by its id
     * @param int $id
     * @return History[]
     */
    public static function findAllById($id) {
        try {
            $database = Database::getInstance()->connect();
            $PDOStatement = $database->prepare("SELECT * FROM history WHERE cityId = :cityId ORDER BY created_at DESC LIMIT 10");
            $PDOStatement->execute([':cityId' => $id]);
            $historyData = $PDOStatement->fetchAll();
            $history = [];
            foreach ($historyData as &$record) {
                $history[] = new History(
                    $record['cityId'],
                    $record['api'],
                    $record['temperature'],
                    $record['humidity'],
                    $record['created_at']
                );
            }
            return $history;
        } catch (PDOException $e) {
            (new ErrorController('smarty'))->index($e->getMessage());
            exit;
        }
    }

    /**
     * Find last the histories of a city by its id
     * @param int $id
     * @return History|null
     */
    public static function findLastById($id) {
        try {
            $database = Database::getInstance()->connect();
            $PDOStatement = $database->prepare("SELECT * FROM history WHERE cityId = :cityId ORDER BY created_at DESC LIMIT 1");
            $PDOStatement->execute([':cityId' => $id]);
            $historyData = $PDOStatement->fetch();
            if ($historyData) {
                return new History(
                    $historyData['cityId'],
                    $historyData['api'],
                    $historyData['temperature'],
                    $historyData['humidity'],
                    $historyData['created_at']
                );
            }
            (new ErrorController('smarty'))->index("No history found");
            exit;
        } catch (PDOException $e) {
            (new ErrorController('smarty'))->index($e->getMessage());
            exit;
        }
    }

    /**
     * Save the history record on the database
     * @param History $weatherData
     */
    public static function save($weatherData) {
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
            (new ErrorController('smarty'))->index($e->getMessage());
            exit;
        }
    }
}
