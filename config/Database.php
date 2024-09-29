<?php

namespace Database;

use Dotenv\Dotenv;
use PDO;
use PDOException;

require '../vendor/autoload.php';

Dotenv::createImmutable(dirname(__FILE__, 2))->load();

class Database {
    public $conn;

    public function getConnection() {
        try {
            $this->conn = new PDO("mysql:host=" . $_ENV['MYSQL_HOSTNAME'] . ";dbname=" . $_ENV['MYSQL_DATABASE'], $_ENV['MYSQL_ROOT_USER'], $_ENV['MYSQL_ROOT_PASSWORD']);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
