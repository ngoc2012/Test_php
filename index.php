<?php
// Include the main Smarty class
require_once __DIR__ . '/smarty-libs/Smarty.class.php';
require_once __DIR__ . '/db.php';

// Create Smarty instance
$smarty = new Smarty();

// Set template directories
$smarty->setTemplateDir(__DIR__ . '/templates/');
$smarty->setCompileDir(__DIR__ . '/templates_c/');

// Database connection
$db = new Database();

try {
    $pdo = $db->connect();

    // Fetch all cities
    $stmt = $pdo->query("SELECT city_name FROM cities");
    $cities = $stmt->fetchAll();

    // Assign to Smarty
    $smarty->assign('cities', $cities);

    // Render the template
    $smarty->display('index.tpl');

} catch (PDOException $e) {
    // Log the error if needed
    error_log($e->getMessage());

    // Assign error message to Smarty (optional)
    $smarty->assign('error_message', 'Sorry, something went wrong with the database: ' . $e->getMessage());

    // Render a custom error page
    $smarty->display('error.tpl');

    // Stop further execution
    exit;
}

?>