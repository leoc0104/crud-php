<?php

class Database {
    private $host = getenv('MYSQL_HOSTNAME');
    private $db_name = getenv('MYSQL_DATABASE');
    private $username = getenv('MYSQL_ROOT_USER');
    private $password = getenv('MYSQL_ROOT_PASSWORD');
    public $conn;

    public function getConnection() {
        $this->conn = null;
        
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
