<?php

require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/product.php';

$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

switch (true) {
    case $uri === '/login' && $method === 'POST':
        login();
        break;
    case $uri === '/logout' && $method === 'POST':
        logout();
        break;

    case $uri === '/products' && $method === 'GET':
        listProducts();
        break;
    case $uri === '/products' && $method === 'POST':
        createProduct();
        break;
    case preg_match('#^/products/(\d+)$#', $uri, $matches) && $method === 'PUT':
        updateProduct((int)$matches[1]);
        break;
    case preg_match('#^/products/(\d+)$#', $uri, $matches) && $method === 'DELETE':
        deleteProduct((int)$matches[1]);
        break;
    default:
        http_response_code(404);
        echo json_encode(["message" => "Endpoint not found"]);
}