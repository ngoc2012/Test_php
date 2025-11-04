<?php
namespace App\Controllers;

require_once __DIR__ . '/../Controllers/BaseController.php';
require_once __DIR__ . '/../Models/Weather.php';

use App\Controllers\BaseController;
use App\Controllers\ErrorController;
use App\Models\Weather;

class CityWeatherController extends BaseController
{
    private $cityName;
    private $cityId;
    private $api;

    public function __construct($viewType = 'smarty', $cityName = null, $api = null)
    {
        parent::__construct($viewType);
        $this->cityName = $cityName;
        $this->api = $api;
    }

    /**
    * Get the city ID from the database.
    */
    private function getCityId()
    {
        // Try to get city ID by name
        $stmt = $this->pdo->prepare("SELECT id FROM cities WHERE name = :name LIMIT 1");
        $stmt->execute([':name' => $this->cityName]);
        $this->cityId = $stmt->fetchColumn();

        if (!$this->cityId) {
            (new ErrorController())->error('No city found with the name: ' . $this->cityName);
            exit;
        }
    }

    /**
    * Get the weather history for the city.
    **/
    private function getHistory()
    {
        // Create history table if not exists (temperature only)
        $this->pdo->exec("
            CREATE TABLE IF NOT EXISTS history (
                id INT AUTO_INCREMENT PRIMARY KEY,
                cityId INT NOT NULL,
                api VARCHAR(100) NOT NULL,
                temperature FLOAT,
                humidity FLOAT,
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (cityId) REFERENCES cities(id)
                    ON DELETE CASCADE
                    ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
        ");

        $stmt = $this->pdo->query("SELECT * FROM history WHERE cityId = " . $this->cityId . " ORDER BY created_at DESC LIMIT 10");
        $history = $stmt->fetchAll();

        // Format date and time for each entry
        foreach ($history as &$entry) {
            $entry['date'] = date('Y-m-d', strtotime($entry['created_at']));
            $entry['time'] = date('H:i:s', strtotime($entry['created_at']));
        }
        unset($entry); // break reference
        return $history;
    }

    /**
     * Insert a new weather record into the history table.
     *
     * @param array $weather An associative array containing 'api', 'temperature', and 'humidity'.
     */
    private function insertHistory($weather)
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO history (cityId, api, temperature, humidity, created_at)
            VALUES (:cityId, :api, :temperature, :humidity, NOW())
        ");
        $stmt->execute([
            ':cityId'      => $this->cityId,
            ':api'         => $weather['api'],
            ':temperature' => $weather['temperature'],
            ':humidity'    => $weather['humidity']
        ]);
    }

    /**
     * Main method to handle the city weather request.
     */
    public function index()
    {
        $this->getCityId();
        $weather = Weather::getMetrics($this->cityName, $this->api);
        $this->insertHistory($weather);
        $history = $this->getHistory();
        $this->render('city_weather.tpl', ['history' => $history, 'city' => $this->cityName, 'weather' => $weather]);
    }
}