<?php
namespace Src\Controllers;

use Src\Database;
use PDO;

class ProductController {
    public static function index($search = null) {
        $db = Database::connect();
        $sql = "SELECT * FROM products";

        if ($search) {
            $sql .= " WHERE name LIKE :name";
        }

        $stmt = $db->prepare($sql);
        
        if ($search) {
            $stmt->bindValue(':name', '%' . $search . '%');
        }
        
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function show($id) {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function store($data) {
        $db = Database::connect();
        $stmt = $db->prepare("INSERT INTO products (name, price) VALUES (?, ?)");

        return $stmt->execute([$data['name'], $data['price']]);
    }

    public static function update($id, $data) {
        $db = Database::connect();

        $stmt = $db->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$id]);

        if ($stmt->fetch(PDO::FETCH_ASSOC) !== false) {
            $stmt = $db->prepare("UPDATE products SET name = ?, price = ? WHERE id = ?");

            return $stmt->execute([$data['name'], $data['price'], $id]);
        }

        return false;
    }

    public static function delete($id) {
        $db = Database::connect();

        $stmt = $db->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$id]);

        if ($stmt->fetch(PDO::FETCH_ASSOC) !== false) {
            $stmt = $db->prepare("DELETE FROM products WHERE id = ?");
            return $stmt->execute([$id]);
        } 

        return false;
    }

    public static function deleteAll() {
        $db = Database::connect();
        $stmt = $db->prepare("TRUNCATE TABLE products");
        return $stmt->execute();
    }
}