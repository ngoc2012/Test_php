<?php
require_once __DIR__ . '/../app/Controllers/CityListController.php';

use App\Controllers\CityListController;

$controller = new CityListController('smarty');
$controller->index();
?>