<?php
require_once 'Product.php';
require_once 'Category.php';
require_once 'Database.php';

// Connexion à la base de données
$db = Database::getConnection();

// ID du produit que nous voulons récupérer
$productId = 7;

// Récupération du produit depuis la base de données
$stmt = $db->prepare("SELECT * FROM product WHERE id = :id");
$stmt->bindParam(':id', $productId, PDO::PARAM_INT);
$stmt->execute();
$productData = $stmt->fetch(PDO::FETCH_ASSOC);

if ($productData) {
    // Création de l'instance du produit à partir des données
    $product = new Product(
        $productData['id'],
        $productData['name'],
        $productData['photos'],
        $productData['price'],
        $productData['description'],
        $productData['quantity'],
        $productData['createdAt'],
        $productData['updatedAt'],
        $productData['category_id']
    );

    // Récupération de la catégorie associée
    $category = $product->getCategory();

    if ($category) {
        echo "Produit : " . $productData['name'] . "<br>";
        echo "Catégorie : " . $category->getName() . "<br>";
        echo "Description de la catégorie : " . $category->getDescription() . "<br>";
    } else {
        echo "Aucune catégorie trouvée pour ce produit.";
    }
} else {
    echo "Aucun produit trouvé avec l'ID $productId.";
}
