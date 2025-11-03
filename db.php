<?php
class Database {
    private $host = 'localhost';
    private $db   = 'test';
    private $user = 'ps_user';
    private $pass = 'ps_password';
    private $charset = 'utf8mb4';
    private $pdo = null;
    private $dsn;
    private $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];

    public function __construct($host = null, $db = null, $user = null, $pass = null, $charset = null) {
        $this->host = isset($host) ? $host : $this->host;
        $this->db = isset($db) ? $db : $this->db;
        $this->user = isset($user) ? $user : $this->user;
        $this->pass = isset($pass) ? $pass : $this->pass;
        $this->charset = isset($charset) ? $charset : $this->charset;
        $this->dsn = "mysql:host={$this->host};dbname={$this->db};charset={$this->charset}";
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

    public function __destruct() {
        $this->pdo = null;
    }
}
