<?php
require_once 'product.php';
require_once 'category.php';

$host = 'localhost';
$dbname = 'draft-shop';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $category = new Category(1, 'Clothing', 'Category for clothing products', new DateTime(), new DateTime());

    $product = new Product(
        7,
        'T-shirt',
        ['https://picsum.photos/200/300'],
        1500,
        'A beautiful T-shirt',
        100,
        new DateTime(),
        new DateTime(),
        $category->getId()
    );

    $sqlCategory = "INSERT INTO category (id, name, description, createdAt, updatedAt) 
                    VALUES (:id, :name, :description, :createdAt, :updatedAt)
                    ON DUPLICATE KEY UPDATE name = :name, description = :description, updatedAt = :updatedAt";

    $stmtCategory = $pdo->prepare($sqlCategory);

    $stmtCategory->bindParam(':id', $category->getId());
    $stmtCategory->bindParam(':name', $category->getName());
    $stmtCategory->bindParam(':description', $category->getDescription());
    $stmtCategory->bindParam(':createdAt', $category->getCreatedAt()->format('Y-m-d H:i:s'));
    $stmtCategory->bindParam(':updatedAt', $category->getUpdatedAt()->format('Y-m-d H:i:s'));

    if ($stmtCategory->execute()) {
        echo "Category inserted/updated successfully.<br>";
    } else {
        echo "Category insertion/update failed.<br>";
    }

    $sqlProduct = "INSERT INTO product (id, name, photos, price, description, quantity, createdAt, updatedAt, category_id) 
                   VALUES (:id, :name, :photos, :price, :description, :quantity, :createdAt, :updatedAt, :category_id)";

    $stmtProduct = $pdo->prepare($sqlProduct);

    $stmtProduct->bindParam(':id', $product->getId());
    $stmtProduct->bindParam(':name', $product->getName());
    $stmtProduct->bindParam(':photos', implode(',', $product->getPhotos()));
    $stmtProduct->bindParam(':price', $product->getPrice());
    $stmtProduct->bindParam(':description', $product->getDescription());
    $stmtProduct->bindParam(':quantity', $product->getQuantity());
    $stmtProduct->bindParam(':createdAt', $product->getCreatedAt()->format('Y-m-d H:i:s'));
    $stmtProduct->bindParam(':updatedAt', $product->getUpdatedAt()->format('Y-m-d H:i:s'));
    $stmtProduct->bindParam(':category_id', $product->getCategoryId());

    if ($stmtProduct->execute()) {
        echo "Product inserted successfully.";
    } else {
        echo "Product insertion failed.";
    }

} catch (PDOException $e) {
    echo 'Erreur : ' . $e->getMessage();
}
?>
