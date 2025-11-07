<?php
require_once __DIR__ . '/../libs/autoload.php';

ini_set('display_errors', 0);
error_reporting(E_ALL);

use App\Controllers\MainController;

MainController::index();
