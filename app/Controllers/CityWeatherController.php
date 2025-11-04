<?php
namespace App\Controllers;

require_once __DIR__ . '/../Core/Database.php';
require_once __DIR__ . '/../Controllers/BaseController.php';

use App\Core\Database;
use App\Controllers\BaseController;

class CityWeatherController extends BaseController
{
    public function __construct($viewType = 'smarty')
    {
        parent::__construct($viewType);
    }

    public function index()
    {
        try {
            $pdo = Database::getInstance()->connect();
        } catch (Exception $e) {
            error_log($e->getMessage());
            $this->view->render('error.tpl',
                ['error_message' => 'Sorry, something went wrong with the database: ' . $e->getMessage()]);
            // Stop further execution
            exit;
        }
        // // Create history table if not exists (temperature only)
        $pdo->exec("
            CREATE TABLE IF NOT EXISTS history (
                id INT AUTO_INCREMENT PRIMARY KEY,
                city_name VARCHAR(100) NOT NULL,
                temperature FLOAT,
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
        ");

        $stmt = $pdo->query("SELECT city_name FROM cities");
        $cities = $stmt->fetchAll();
        $this->view->render('index.tpl', ['cities' => $cities]);
    }
}
