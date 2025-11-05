<?php
namespace App\Controllers;

require_once __DIR__ . '/../Controllers/ViewController.php';
require_once __DIR__ . '/../Models/City.php';

use App\Controllers\ViewController;
use \App\Models\City;

class CityListController extends ViewController {

    /**
     * CityListController constructor.
     * @param string $viewType smarty|raintpl
     * @return void
     */
    public function __construct($viewType = 'smarty') {
        parent::__construct($viewType);
    }

    /**
     * Display the list of cities.
     * @return void
     */
    public function index() {
        $this->render('index.tpl', ['cities' => City::findAll()]);
    }
}
