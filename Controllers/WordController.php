<?php

namespace WordController;

use Database\Database;
use PDO;
use Word\Word;

require_once '../Models/Word.php';
require_once '../config/Database.php';

class WordController {

    private $db;
    private $word;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->word = new Word($this->db);
    }

    public function index() {
        $result = $this->word->readAll();
        $words = $result->fetchAll(PDO::FETCH_ASSOC);

        header('Content-Type: application/json');
        echo json_encode($words);
    }

    public function show($id) {
        $word = $this->word->read($id);

        header('Content-Type: application/json');
        echo json_encode($word);
    }

    public function store() {
        $data = json_decode(file_get_contents("php://input"));

        if (
            !empty($data->name)
            && !empty($data->translation)
            && !empty($data->subject)
            && !empty($data->context_applied)
        ) {
            $this->word->name = $data->name;
            $this->word->translation = $data->translation;
            $this->word->subject = $data->subject;
            $this->word->context_applied = $data->context_applied;

            if ($this->word->create()) {
                header('Content-Type: application/json');
                echo json_encode(['message' => 'Word created']);
            } else {
                header('Content-Type: application/json');
                echo json_encode(['message' => 'Word has not been created']);
            }
        } else {
            header('Content-Type: application/json');
            echo json_encode(['message' => 'Incomplete data']);
        }
    }

    public function update($id) {
        $data = json_decode(file_get_contents("php://input"));

        if (
            !empty($data->name)
            && !empty($data->translation)
            && !empty($data->subject)
            && !empty($data->context_applied)
        ) {
            $this->word->name = $data->name;
            $this->word->translation = $data->translation;
            $this->word->subject = $data->subject;
            $this->word->context_applied = $data->context_applied;

            if ($this->word->update()) {
                header('Content-Type: application/json');
                echo json_encode(['message' => 'Word updated']);
            } else {
                header('Content-Type: application/json');
                echo json_encode(['message' => 'Word has not been updated']);
            }
        } else {
            header('Content-Type: application/json');
            echo json_encode(['message' => 'Incomplete data']);
        }
    }

    public function destroy($id) {
        $this->word->id = $id;

        if ($this->word->delete()) {
            header('Content-Type: application/json');
            echo json_encode(['message' => 'Word deleted']);
        } else {
            header('Content-Type: application/json');
            echo json_encode(['message' => 'Word has not been deleted']);
        }
    }
}
