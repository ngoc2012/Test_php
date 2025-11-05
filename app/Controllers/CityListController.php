<?php
namespace App\Controllers;

use App\Controllers\ViewController;
use App\Models\City;

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
