<?php
require_once 'Database.php';
require_once 'Product.php';

class Category {
    private $id;
    private $name;
    private $description;
    private $createdAt;
    private $updatedAt;

    public function __construct($id = null) {
        if ($id !== null) {
            $this->id = $id;
            $this->loadCategory();
        }
    }

    // Charge les informations d'une catégorie en fonction de l'ID
    private function loadCategory() {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM category WHERE id = :id");
        $stmt->execute(['id' => $this->id]);
        $category = $stmt->fetch();

        if ($category) {
            $this->name = $category['name'];
            $this->description = $category['description'];
            $this->createdAt = $category['createdAt'];
            $this->updatedAt = $category['updatedAt'];
        }
    }

    // Méthode pour récupérer les produits liés à cette catégorie
    public function getProducts() {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM product WHERE category_id = :category_id");
        $stmt->execute(['category_id' => $this->id]);
        $productsData = $stmt->fetchAll();

        $products = [];
        foreach ($productsData as $productData) {
            $product = new Product();
            $product->hydrate($productData);  // On hydrate les produits récupérés
            $products[] = $product;
        }

        return $products;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getCreatedAt() {
        return $this->createdAt;
    }

    public function getUpdatedAt() {
        return $this->updatedAt;
    }
}
