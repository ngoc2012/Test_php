<?php

require_once __DIR__ . '/../app/Controllers/ErrorController.php';
require_once __DIR__ . '/../app/Controllers/CityWeatherController.php';

use App\Controllers\CityWeatherController;
use App\Controllers\ErrorController;

if (!isset($_POST['cityName'])) {
    (new ErrorController())->error('Missing city data.');
}

$controller = new CityWeatherController('smarty', $_POST['cityName']);
$controller->index();
?>