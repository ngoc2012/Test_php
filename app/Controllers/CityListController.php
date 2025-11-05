<?php
namespace App\Controllers;

require_once __DIR__ . '/../Controllers/ViewController.php';
require_once __DIR__ . '/../Models/City.php';

use App\Controllers\ViewController;
use \App\Models\City;

/**
 * Controller for the main page: Listing all the cities
 */
class CityListController extends ViewController {

    /**
     * Display the list of cities.
     * @return void
     */
    public function index() {
        $this->render('index.tpl', ['cities' => City::findAll()]);
    }
}
