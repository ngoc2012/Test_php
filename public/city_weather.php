<?php
require_once __DIR__ . '/../libs/autoload.php';

use App\Controllers\CityWeatherController;

$controller = new CityWeatherController('smarty');
$controller->index();
