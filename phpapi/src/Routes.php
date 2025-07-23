<?php
use Src\Controllers\AuthController;
use Src\Controllers\ProductController;

// header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
// header('Access-Control-Allow-Credentials: true');

header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS');

header('Access-Control-Allow-Headers: X-Requested-With, Authorization, Content-Type');

header('Access-Control-Max-Age: 86400');

if (strtolower($_SERVER['REQUEST_METHOD']) == 'OPTIONS') {
    http_response_code(200);
    exit();
}

session_start();

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/Controllers/AuthController.php';
require_once __DIR__ . '/Controllers/ProductController.php';

if ($uri === '/login' && $method === 'POST') {
    $data = $_POST;

    if (AuthController::login($data['username'], $data['password'])) {
        http_response_code(200);
        echo 'Login done successfully';
    } else {
        http_response_code(401);
        'Login failed';
    }
    
    return;
}

if ($uri === '/logout' && $method === 'GET') {
    AuthController::logout();
    echo 'Logged out successfully';
    return;
}

if (!AuthController::check()) {
    http_response_code(401);
    // echo 'Unauthorized';
    return;
}

switch ($uri) {
    case substr($uri, -1) === '/':
        if ($method === 'GET') {
            http_response_code(200);
            echo "Route not found or localhost test";
        }
        break;

    case '/products':
        if ($method === 'GET') {
            $search = $_GET['search'] ?? null;

            $data = ProductController::index($search);
            
            echo sizeof($data) ? json_encode($data) : 'Product(s) not found';
        } elseif ($method === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            
            if ($data === null) {
                $data = $_POST;
            }
            
            if (ProductController::store($data)) {
                echo 'Product created successfully';
            } else {
                echo 'Failure creating product';
            }
        }
        break;

    case '/products/delete-all':
        if ($method === 'DELETE') {
            echo ProductController::deleteAll() ? 'Products deleted successfully' : 'Failure deleting products';
        } 

        break;

    case preg_match('#^/products/(\d+)$#', $uri, $matches) ? true : false:
        $id = $matches[1];
        if ($method === 'GET') {            
            $data = ProductController::show($id);
            $_SESSION['produtos'] = $data;
            echo $data !== 'false' ? json_encode($data) : 'Product not found';        
        } elseif ($method === 'PUT') {
            $data = json_decode(file_get_contents('php://input'), true);
            echo ProductController::update($id, $data) ? 'Product updated successfully' : 'Product not found';
            // echo 'Product updated';
        } elseif ($method === 'DELETE') {
            echo ProductController::delete($id) !== false ? 'Product deleted successfully' : 'Product not found';
        }
        break;

    default:
        http_response_code(404);
        echo 'Not Found';
}