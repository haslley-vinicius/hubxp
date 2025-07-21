<?php

use PHPUnit\Framework\TestCase;
use Src\Controllers\ProductController;

require_once __DIR__ . '/../vendor/autoload.php';

final class ProductTest extends TestCase {
    public function testCanCreateProduct(): void {
        $result = ProductController::store(['name' => 'Test', 'price' => 100]);
        $this->assertTrue($result);
    }

    public function testCanListProducts(): void {
        $products = ProductController::index();
        $this->assertIsArray($products);
    }

    public function testCanSearchProducts(): void {
        $products = ProductController::index('Test');
        $this->assertIsArray($products);
    }
}