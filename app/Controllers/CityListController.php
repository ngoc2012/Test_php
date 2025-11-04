<?php
namespace App\Controllers;

require_once __DIR__ . '/../Core/Database.php';
require_once __DIR__ . '/../Controllers/BaseController.php';

use App\Core\Database;
use App\Controllers\BaseController;

class CityListController extends BaseController
{
    public function __construct($viewType = 'smarty')
    {
        parent::__construct($viewType);
    }

    public function index()
    {
        try {
            $pdo = Database::getInstance()->connect();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            $this->view->render('error.tpl', ['error_message' => 'Sorry, something went wrong with the database: ' . $e->getMessage()]);
            // Stop further execution
            exit;
        }
        $stmt = $pdo->query("SELECT city_name FROM cities");
        $cities = $stmt->fetchAll();
        $this->view->render('city_weather.tpl', ['cities' => $cities]);
    }
}
