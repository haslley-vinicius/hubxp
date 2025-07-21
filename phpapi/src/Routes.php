<?php
use Src\Controllers\AuthController;
use Src\Controllers\ProductController;

session_start();

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/Controllers/AuthController.php';
require_once __DIR__ . '/Controllers/ProductController.php';

if ($uri === '/login' && $method === 'POST') {
    $data = $_POST;
    echo AuthController::login($data['username'], $data['password']) ? 'OK' : 'FAIL';
    return;
}

if (!AuthController::check()) {
    http_response_code(401);
    echo 'Unauthorized';
    return;
}

switch ($uri) {
    case '/products':
        if ($method === 'GET') {
            $search = $_GET['search'] ?? null;
            echo json_encode(ProductController::index($search));
        } elseif ($method === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            ProductController::store($data);
            echo 'Created';
        }
        break;

    case preg_match('#^/products/(\d+)$#', $uri, $matches) ? true : false:
        $id = $matches[1];
        if ($method === 'GET') {
            echo json_encode(ProductController::show($id));
        } elseif ($method === 'PUT') {
            $data = json_decode(file_get_contents('php://input'), true);
            ProductController::update($id, $data);
            echo 'Updated';
        } elseif ($method === 'DELETE') {
            ProductController::delete($id);
            echo 'Deleted';
        }
        break;

    default:
        http_response_code(404);
        echo 'Not Found';
}