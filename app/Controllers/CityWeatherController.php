<?php
namespace App\Controllers;

require_once __DIR__ . '/../Core/Database.php';
require_once __DIR__ . '/../Controllers/BaseController.php';
require_once __DIR__ . '/../Models/Weather.php';

use App\Core\Database;
use App\Controllers\BaseController;
use App\Models\Weather;

class CityWeatherController extends BaseController
{
    private $cityName;

    public function __construct($viewType = 'smarty', $cityName = null)
    {
        parent::__construct($viewType);
        $this->cityName = $cityName;
    }

    private function getHistory()
    {
        // Create history table if not exists (temperature only)
        $this->pdo->exec("
            CREATE TABLE IF NOT EXISTS history (
                id INT AUTO_INCREMENT PRIMARY KEY,
                cityName VARCHAR(100) NOT NULL,
                temperature FLOAT,
                humidity FLOAT,
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
        ");

        $stmt = $this->pdo->query("SELECT * FROM history WHERE cityName = " . $this->pdo->quote($this->cityName) . " ORDER BY created_at DESC LIMIT 10");
        $history = $stmt->fetchAll();

        // Format date and time for each entry
        foreach ($history as &$entry) {
            $entry['date'] = date('Y-m-d', strtotime($entry['created_at']));
            $entry['time'] = date('H:i:s', strtotime($entry['created_at']));
        }
        unset($entry); // break reference
        return $history;
    }

    private function insertHistory($weather)
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO history (cityName, temperature, humidity, created_at)
            VALUES (:cityName, :temperature, :humidity, NOW())
        ");
        $stmt->execute([
            ':cityName'   => $this->cityName,
            ':temperature' => $weather['temperature'],
            ':humidity'    => $weather['humidity']
        ]);
    }

    public function index()
    {
        $history = $this->getHistory();
        $weather = Weather::getMetrics($this->cityName, null);
        $this->insertHistory($weather);
        $this->view->render('city_weather.tpl', ['history' => $history, 'city' => $this->cityName, 'weather' => $weather]);
    }
}
