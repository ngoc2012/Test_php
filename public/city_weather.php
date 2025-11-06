<?php
require_once __DIR__ . '/../libs/autoload.php';

use App\Controllers\CityWeatherController;
use App\Controllers\ErrorController;
use App\Models\City;

// ================================
// === Validate POST parameters ===
// ================================

if (!isset($_POST['id'])) {
    (new ErrorController())->index('Missing city ID.');
    exit;
}

if (!isset($_POST['name'])) {
    (new ErrorController())->index('Missing city data.');
    exit;
}

if (!isset($_POST['api'])) {
    (new ErrorController())->index('Missing API data.');
    exit;
}

// Convert ID to integer
$cityId = (int) $_POST['id'];
if ($cityId <= 0) {
    (new ErrorController())->index('Invalid City ID.');
    exit;
}
$cityName = trim($_POST['name']);
$city = new City($cityId, $cityName);
$api = trim($_POST['api']);

$controller = new CityWeatherController('smarty');
$controller->index($city, $api);
