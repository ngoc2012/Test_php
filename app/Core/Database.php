<?php
namespace App\Core;

require_once __DIR__ . '/../../config/config.php';

use PDO;
use PDOException;
use Exception;

class Database {
    private $host;
    private $db;
    private $user;
    private $pass;
    private $charset;
    private $pdo = null;
    private $dsn;
    private $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];

    // Singleton instance
    private static $instance = null;

    public function __construct($host = null, $db = null, $user = null, $pass = null, $charset = null) {
        $this->host = $host ?: DB_HOST;
        $this->db = $db ?: DB_NAME;
        $this->user = $user ?: DB_USER;
        $this->pass = $pass ?: DB_PASS;
        $this->charset = $charset ?: 'utf8mb4';
        $this->dsn = "mysql:host={$this->host};dbname={$this->db};charset={$this->charset}";
    }

    // Prevent cloning
    private function __clone() {}

    // Prevent unserialization
    private function __wakeup() {}

    // Get the singleton instance
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function connect() {
        if ($this->pdo === null) {
            try {
                $this->pdo = new PDO($this->dsn, $this->user, $this->pass, $this->options);
            } catch (PDOException $e) {
                throw new Exception("Database connection failed: " . $e->getMessage());
            }
        }
        return $this->pdo;
    }

    private function closeConnection() {
        $this->pdo = null;
    }

    public function __destruct() {
        $this->closeConnection();
    }
}
?>