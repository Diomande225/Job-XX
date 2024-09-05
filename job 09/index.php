<?php
require_once 'Product.php';

// Crée une instance de Product avec les informations du produit
$product = new Product(
    null, // ID du produit, mis à null car il sera généré automatiquement
    'T-shirt', // Nom du produit
    ['https://picsum.photos/200/300'], // Un tableau contenant l'URL de l'image
    1000, // Prix
    'A beautiful T-shirt', // Description
    10, // Quantité
    new DateTime(), // Date de création
    new DateTime(), // Date de mise à jour
    1 // ID de la catégorie
);

// Appel de la méthode create pour insérer le produit dans la base de données
$createdProduct = $product->create();

if ($createdProduct) {
    echo "Produit créé avec succès avec l'ID " . $createdProduct->id;
} else {
    echo "Échec de la création du produit.";
}
