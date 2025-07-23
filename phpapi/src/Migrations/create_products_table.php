<?php
require 'vendor/autoload.php';
require_once __DIR__ . '/../Database.php';

use Src\Database;

$db = Database::connect();

$sql = "
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    price DECIMAL(10,2) NOT NULL
) ENGINE=INNODB;

INSERT INTO products (name, price) VALUES ('Produto Teste 1', 36.57), ('Produto Teste 2', 10.96), ('Produto Teste 3', 130.78);
";

$db->exec($sql);

echo "Migration completed.\n";