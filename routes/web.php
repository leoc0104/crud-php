<?php

require_once '../controllers/ProductController.php';
require_once '../config/Database.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);

$controller = new ProductController();

if ($uri[2] == 'products' && $_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($uri[3])) {
        $controller->show($uri[3]); // GET /products/{id}
    } else {
        $controller->index(); // GET /products
    }
} elseif ($uri[2] == 'products' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $controller->store(); // POST /products
} elseif ($uri[2] == 'products' && $_SERVER['REQUEST_METHOD'] == 'PUT') {
    $controller->update($uri[3]); // PUT /products/{id}
} elseif ($uri[2] == 'products' && $_SERVER['REQUEST_METHOD'] == 'DELETE') {
    $controller->destroy($uri[3]); // DELETE /products/{id}
} elseif ($uri[2] == 'test' && $_SERVER['REQUEST_METHOD'] == 'GET') {
    $database = new Database();
    $connection = $database->getConnection();
    
    echo '<h1>Database Connection Test</h1>';
    echo '<pre>';
    var_dump($connection);
    echo '</pre>';
} else {
    header("HTTP/1.1 404 Not Found");
    echo json_encode(['message' => 'Route not found']);
}
