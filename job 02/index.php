<?php

// Inclure les classes Category et Product
require_once 'Category.php';
require_once 'Product.php';

// Instancier une catégorie
$category = new Category(1, 'Clothing', 'Category for clothing items', new DateTime(), new DateTime());

// Instancier un produit associé à la catégorie
$product = new Product(1, 'T-shirt', ['https://picsum.photos/200/300'], 1000, 'A beautiful T-shirt', 10, new DateTime(), new DateTime(), $category->getId());

// Utiliser var_dump pour afficher les valeurs initiales
echo "Valeurs de la catégorie :\n";
var_dump($category->getId());
var_dump($category->getName());
var_dump($category->getDescription());
var_dump($category->getCreatedAt());
var_dump($category->getUpdatedAt());

echo "\nValeurs initiales du produit :\n";
var_dump($product->getId());
var_dump($product->getName());
var_dump($product->getPhotos());
var_dump($product->getPrice());
var_dump($product->getDescription());
var_dump($product->getQuantity());
var_dump($product->getCreatedAt());
var_dump($product->getUpdatedAt());
var_dump($product->getCategoryId()); // Afficher l'ID de la catégorie associée

// Modifier certaines propriétés du produit
$product->setPrice(1200);
$product->setDescription('An updated description for the beautiful T-shirt');

// Utiliser var_dump pour afficher les valeurs après modification
echo "\nValeurs après modification du produit :\n";
var_dump($product->getPrice());
var_dump($product->getDescription());
