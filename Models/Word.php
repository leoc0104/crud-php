<?php

namespace Word;

use PDO;

class Word {
    private $conn;
    private $table = 'words';

    public $id;
    public $name;
    public $translation;
    public $subject;
    public $context_applied;

    public function __construct(PDO $db) {
        $this->conn = $db;
    }

    public function read($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function readAll() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table . " SET name=:name, translation=:translation, subject=:subject, context_applied=:context_applied";
        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->translation = htmlspecialchars(strip_tags($this->translation));
        $this->subject = htmlspecialchars(strip_tags($this->subject));
        $this->context_applied = htmlspecialchars(strip_tags($this->context_applied));

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":translation", $this->translation);
        $stmt->bindParam(":subject", $this->subject);
        $stmt->bindParam(":context_applied", $this->context_applied);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function update() {
        $query = "UPDATE " . $this->table . " SET name=:name, translation=:translation, subject=:subject, context_applied=:context_applied";
        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->translation = htmlspecialchars(strip_tags($this->translation));
        $this->subject = htmlspecialchars(strip_tags($this->subject));
        $this->context_applied = htmlspecialchars(strip_tags($this->context_applied));

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":translation", $this->translation);
        $stmt->bindParam(":subject", $this->subject);
        $stmt->bindParam(":context_applied", $this->context_applied);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(1, $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
