<?php
require_once __DIR__ . '/../libs/autoload.php';

use App\Controllers\CityListController;

$controller = new CityListController('raintpl');
$controller->index();
