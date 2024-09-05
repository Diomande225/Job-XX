<?php

// Inclure la classe Product
require_once 'Product.php';

// Instancier la classe Product avec les valeurs de l'image fournie
$product = new Product(1, 'T-shirt', ['https://picsum.photos/200/300'], 1000, 'A beautiful T-shirt', 10, new DateTime(), new DateTime());

// Utiliser var_dump pour afficher les valeurs initiales
echo "Valeurs initiales :\n";
var_dump($product->getId());
var_dump($product->getName());
var_dump($product->getPhotos());
var_dump($product->getPrice());
var_dump($product->getDescription());
var_dump($product->getQuantity());
var_dump($product->getCreatedAt());
var_dump($product->getUpdatedAt());

// Modifier certaines propriétés avec les setters
$product->setPrice(1200);
$product->setDescription('An updated description for the beautiful T-shirt');

// Utiliser var_dump pour afficher les valeurs après modification
echo "\nValeurs après modification :\n";
var_dump($product->getPrice());
var_dump($product->getDescription());
