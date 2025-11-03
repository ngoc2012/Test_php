<?php
require_once __DIR__ . '/smarty-libs/Smarty.class.php';

$smarty = new Smarty();
$smarty->setTemplateDir(__DIR__ . '/templates/');
$smarty->setCompileDir(__DIR__ . '/templates_c/');

if (!isset($_POST['city_name'])) {
    die('Missing city data.');
}

$city_name = $_POST['city_name'];
$city_name_escaped = urlencode($city_name);

// Connect to DB
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

// Create history table if not exists (temperature only)
$pdo->exec("
    CREATE TABLE IF NOT EXISTS history (
        id INT AUTO_INCREMENT PRIMARY KEY,
        city_name VARCHAR(100) NOT NULL,
        temperature FLOAT,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
");

$stmt = $pdo->query("SELECT * FROM history WHERE city_name = " . $pdo->quote($city_name) . " ORDER BY created_at DESC LIMIT 10");
$history = $stmt->fetchAll();

// Format date and time for each entry
foreach ($history as &$entry) {
    $entry['date'] = date('Y-m-d', strtotime($entry['created_at']));
    $entry['time'] = date('H:i:s', strtotime($entry['created_at']));
}
unset($entry); // break reference


// OpenWeatherMap API key
$apiKey = '6bd83c8ba20d3606bd49cef93d45f943';

// API URL
$url = "https://api.openweathermap.org/data/2.5/weather?q={$city_name_escaped}&units=metric&lang=en&appid={$apiKey}";

// Fetch weather
$response = file_get_contents($url);
if (!$response) {
    die('Failed to fetch weather data.');
}

$weatherData = json_decode($response, true);

// Extract temperature
$temperature = $weatherData['main']['temp'];

if ($temperature === null) {
    die('Temperature data not found.');
}

// Insert into history
$stmt = $pdo->prepare("
    INSERT INTO history (city_name, temperature, created_at)
    VALUES (:city_name, :temperature, NOW())
");

$stmt->execute([
    ':city_name'   => $city_name,
    ':temperature' => $temperature
]);
$smarty->assign('history', $history);
$smarty->assign('city_name', $city_name);
$smarty->assign('weather', $weatherData);
$smarty->display('city_weather.tpl');
?>