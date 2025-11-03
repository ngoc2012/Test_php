<?php
// Include the main Smarty class
require_once __DIR__ . '/smarty-libs/Smarty.class.php';

// Create Smarty instance
$smarty = new Smarty();

// Set template directories
$smarty->setTemplateDir(__DIR__ . '/templates/');
$smarty->setCompileDir(__DIR__ . '/templates_c/');

// Database connection
$host = 'localhost';
$db   = 'test';
$user = 'ps_user';
$pass = 'ps_password';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Fetch all cities
$stmt = $pdo->query("SELECT city_name FROM cities ORDER BY city_name ASC");
$cities = $stmt->fetchAll();

// Assign to Smarty
$smarty->assign('cities', $cities);

// Render the template
$smarty->display('index.tpl');
?>