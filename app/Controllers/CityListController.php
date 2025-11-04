<?php
namespace App\Controllers;

require_once __DIR__ . '/../Controllers/BaseController.php';
require_once __DIR__ . '/../Models/CitiesList.php';

use App\Controllers\BaseController;
use App\Models\CitiesList;

class CityListController extends BaseController
{
    public function __construct($viewType = 'smarty')
    {
        parent::__construct($viewType);
    }

    /**
     * Display the list of cities.
     * @return void
     */
    public function index()
    {
        $stmt = $this->pdo->query("SELECT * FROM cities");
        $cities = $stmt->fetchAll();
        $citiesList = new CitiesList();
        $citiesList->setCities($cities);
        $this->render('index.tpl', ['cities' => $citiesList->toArray()]);
    }
}
