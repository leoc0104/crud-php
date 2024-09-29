<?php

use WordController\WordController;

require_once '../Controllers/WordController.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);

$controller = new WordController();

if ($uri[1] == 'words' && $_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($uri[2])) {
        $controller->show($uri[2]);
    } else {
        $controller->index();
    }
} elseif ($uri[1] == 'words' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $controller->store();
} elseif ($uri[1] == 'words' && $_SERVER['REQUEST_METHOD'] == 'PUT') {
    $controller->update($uri[2]);
} elseif ($uri[1] == 'words' && $_SERVER['REQUEST_METHOD'] == 'DELETE') {
    $controller->destroy($uri[2]);
} else {
    header("HTTP/1.1 404 Not Found");
    echo json_encode(['message' => 'Route not found']);
}