<?php
require_once __DIR__ . '/../Database.php';

use Src\Database;

$db = Database::connect();

$sql = "
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    price DECIMAL(10,2) NOT NULL
) ENGINE=INNODB;
";

$db->exec($sql);

echo "Migration completed.\n";