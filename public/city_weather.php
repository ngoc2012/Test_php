<?php

require_once __DIR__ . '/../app/Controllers/ErrorController.php';
require_once __DIR__ . '/../app/Controllers/CityWeatherController.php';

use App\Controllers\CityWeatherController;
use App\Controllers\ErrorController;


// ================================
// === Validate POST parameters ===
// ================================

if (!isset($_POST['id'])) {
    (new ErrorController())->error('Missing city ID.');
    exit;
}

if (!isset($_POST['name'])) {
    (new ErrorController())->error('Missing city data.');
    exit;
}

if (!isset($_POST['api'])) {
    (new ErrorController())->error('Missing API data.');
    exit;
}

// Convert ID to integer
$cityId = (int) $_POST['id'];
if ($cityId <= 0) {
    (new ErrorController())->error('Invalid City ID.');
    exit;
}

$cityName = trim($_POST['name']);
$api = trim($_POST['api']);

$controller = new CityWeatherController('smarty');
$controller->index($cityId, $cityName, $api);
