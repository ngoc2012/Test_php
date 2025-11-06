<?php
namespace App\Controllers;

use App\Controllers\AbstractViewController;
use App\Models\City;

/**
 * Controller for the main page: Listing all the cities
 */
class CityListController extends AbstractViewController {

    
    // =========================
    // === Public Methods ======
    // =========================
    
    /**
     * Display the list of cities.
     * @return void
     */
    public function init() {
        try {
            $cities = City::findAll();
        } catch (\DBException $e) {
            (new ErrorController('smarty'))->init($e->getMessage());
            exit;
        }
        $this->getView()->render('index.tpl', ['cities' => $cities]);
    }
}
