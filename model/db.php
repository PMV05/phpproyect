<?php
require_once __DIR__ . '/../../config.php';

class Database {
    private static $instance = null;
    private $pdo;

    public static function getInstance(): Database {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    private function __construct() {
        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;

        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, 
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];

        try {
            $this->pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
        } catch (PDOException $e) {
            die("DB Connection failed: " . $e->getMessage());
        }
    }

    public function getConnection(): PDO {
        return $this->pdo;
    }

    public function query(string $sql, array $params = []): PDOStatement {
        $statement = $this->pdo->prepare($sql);
        $statement->execute($params);
        return $statement;
    }

    public function fetch(string $sql, array $params = []): ?array {
        $statement = $this->query($sql, $params);
        $row = $statement->fetch();
        return $row === false ? null : $row;
    }

    public function fetchAll(string $sql, array $params = []): array {
        $statement = $this->query($sql, $params);
        return $statement->fetchAll();
    }

    public function execute(string $sql, array $params = []): int {
        $statement = $this->query($sql, $params);
        return $statement->rowCount();
    }

    public function lastInsertId(): string {
        return $this->pdo->lastInsertId();
    }
}
