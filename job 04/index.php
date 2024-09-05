<?php
require_once 'Product.php';

$host = 'localhost';
$dbname = 'draft-shop';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $productId = 7;

    $sql = "SELECT * FROM product WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $productId, PDO::PARAM_INT);
    $stmt->execute();

    $productData = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($productData) {
        $product = new Product(
            $productData['id'],
            $productData['name'],
            explode(',', $productData['photos']),
            $productData['price'],
            $productData['description'],
            $productData['quantity'],
            new DateTime($productData['createdAt']),
            new DateTime($productData['updatedAt']),
            $productData['category_id']
        );
        echo "Produit trouvé : " . $product->getName();
    } else {
        echo "Aucun produit trouvé avec l'ID $productId.";
    }

} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
