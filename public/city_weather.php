<?php

require_once __DIR__ . '/../app/Controllers/ErrorController.php';
require_once __DIR__ . '/../app/Controllers/CityWeatherController.php';

use App\Controllers\CityWeatherController;
use App\Controllers\ErrorController;

if (!isset($_POST['cityName'])) {
    (new ErrorController())->error('Missing city data.');
}
if (!isset($_POST['api'])) {
    (new ErrorController())->error('Missing API data.');
}

$controller = new CityWeatherController('smarty', $_POST['cityName'], $_POST['api']);
$controller->index();
?>