<?php
require_once 'Database.php';
require_once 'Category.php';

class Product {
    private $id;
    private $name;
    private $photos;
    private $price;
    private $description;
    private $quantity;
    private $createdAt;
    private $updatedAt;
    private $categoryId;

    public function __construct($id = null) {
        if ($id !== null) {
            $this->id = $id;
            $this->loadProduct();
        }
    }

    // Charge les informations d'un produit en fonction de l'ID
    private function loadProduct() {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM product WHERE id = :id");
        $stmt->execute(['id' => $this->id]);
        $product = $stmt->fetch();

        if ($product) {
            $this->hydrate($product);
        }
    }

    // Hydrate l'objet Product avec un tableau de données
    public function hydrate($data) {
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->photos = $data['photos'];
        $this->price = $data['price'];
        $this->description = $data['description'];
        $this->quantity = $data['quantity'];
        $this->createdAt = $data['createdAt'];
        $this->updatedAt = $data['updatedAt'];
        $this->categoryId = $data['category_id'];
    }

    // Méthode pour récupérer l'objet Category associé
    public function getCategory() {
        return new Category($this->categoryId);
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getPhotos() {
        return $this->photos;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function getCreatedAt() {
        return $this->createdAt;
    }

    public function getUpdatedAt() {
        return $this->updatedAt;
    }
}
