<?php
require_once __DIR__ . '/database.php';

$db = db();

$db->exec("
    CREATE DATABASE IF NOT EXISTS phpapi;

    USE phpapi;

    CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL
    );

    CREATE TABLE IF NOT EXISTS products (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        price DECIMAL(10,2) NOT NULL
    );
");

// Cria usuário padrão
$stmt = $db->prepare("SELECT COUNT(*) FROM users");

if ($stmt->execute() && $stmt->fetchColumn() == 0) {
    $db->prepare("INSERT INTO users (username, password) VALUES (?, ?)")
        ->execute(['admin', password_hash('1234', PASSWORD_DEFAULT)]);
    echo "Usuário padrão criado: admin / 1234\n";
}