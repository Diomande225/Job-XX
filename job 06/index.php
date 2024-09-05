<?php
require_once 'Category.php';

// ID de la catégorie que vous voulez récupérer (par exemple, 1)
$categoryId = 1;

// Récupérer la catégorie avec l'ID donné
$category = new Category($categoryId);

// Afficher les informations de la catégorie
echo "Nom de la catégorie : " . $category->getName() . "<br>";
echo "Description : " . $category->getDescription() . "<br><br>";

// Récupérer et afficher les produits liés à cette catégorie
$products = $category->getProducts();

if (!empty($products)) {
    echo "Produits associés :<br>";
    foreach ($products as $product) {
        echo "Nom du produit : " . $product->getName() . "<br>";
        echo "Description : " . $product->getDescription() . "<br>";
        echo "Prix : " . $product->getPrice() . " €<br>";
        echo "Quantité disponible : " . $product->getQuantity() . "<br><br>";
    }
} else {
    echo "Aucun produit trouvé pour cette catégorie.";
}
