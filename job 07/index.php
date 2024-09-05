<?php
require_once 'Product.php';

// ID du produit que vous voulez récupérer (par exemple, 7)
$productId = 7;

// Créer une nouvelle instance de Product
$product = new Product();

// Appeler la méthode findOneById pour récupérer le produit
$result = $product->findOneById($productId);

if ($result) {
    // Le produit a été trouvé et est hydraté
    echo "Nom du produit : " . $product->getName() . "<br>";
    echo "Description : " . $product->getDescription() . "<br>";
    echo "Prix : " . $product->getPrice() . " €<br>";
    echo "Quantité disponible : " . $product->getQuantity() . "<br>";
    echo "Catégorie : " . $product->getCategory()->getName() . "<br>";
} else {
    // Aucun produit trouvé avec cet ID
    echo "Aucun produit trouvé avec l'ID $productId.";
}
