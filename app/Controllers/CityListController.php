<?php
namespace App\Controllers;

use App\Controllers\AbstractViewController;
use App\Models\City;

/**
 * Controller for the main page: Listing all the cities
 */
class CityListController extends AbstractViewController {

    /**
     * Display the list of cities.
     * @return void
     */
    public function init() {
        $this->getView()->render('index.tpl', ['cities' => City::findAll()]);
    }
}
