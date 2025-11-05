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

class History {
    /* @var int history id */
    private $id;

    /* @var int city id */
    private $cityId;

    /* @var string API used */
    private $api;

    /* @var float temperature */
    private $temperature;

    /* @var float humidity */
    private $humidity;

    /* @var string creation timestamp */
    private $createdAt;

    /* @var PDO instance */
    private $pdo;

    /**
     * Constructor
     * @param int $id
     * @param int $cityId
     * @param string $api
     * @param float $temperature
     * @param float $humidity
     * @param string $createdAt
     */
    public function __construct($id, $cityId, $api, $temperature, $humidity, $createdAt) {
        $this->id = $id;
        $this->cityId = $cityId;
        $this->api = $api;
        $this->temperature = $temperature;
        $this->humidity = $humidity;
        $this->createdAt = $createdAt;
    }

    // ===============
    // === GETTERS ===
    // ===============
    public function getId() {
        return $this->id;
    }
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
     * @return array{id: int, cityId: int, api: string, temperature: float, humidity: float, createdAt: string} associative array of history records
     */
    public static function findAllById($id) {
        try {
            $db = Database::getInstance()->connect();
            $stmt = $db->prepare("SELECT * FROM history WHERE cityId = :cityId ORDER BY created_at DESC LIMIT 10");
            $stmt->execute([':cityId' => $id]);
            $history = $stmt->fetchAll();
            return $history;
        } catch (PDOException $e) {
            (new ErrorController('smarty'))->error($e->getMessage());
            exit;
        }
    }

    /**
     * Create a new history record
     * @param int $cityId
     * @param array{api: string, temperature: float, humidity: float} $weather
     * @return void
     */
    public static function create($cityId, $weather) {
        try {
            $db = Database::getInstance()->connect();
            $stmt = $db->prepare("
                INSERT INTO history (cityId, api, temperature, humidity, created_at)
                VALUES (:cityId, :api, :temperature, :humidity, NOW())
            ");
            $stmt->execute([
                ':cityId'      => $cityId,
                ':api'         => $weather['api'],
                ':temperature' => $weather['temperature'],
                ':humidity'    => $weather['humidity']
            ]);
        } catch (PDOException $e) {
            (new ErrorController('smarty'))->error($e->getMessage());
            exit;
        }
    }
}
