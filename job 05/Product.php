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
    private $category_id;

    public function __construct($id = null, $name = null, $photos = null, $price = null, $description = null, $quantity = null, $createdAt = null, $updatedAt = null, $category_id = null) {
        $this->id = $id;
        $this->name = $name;
        $this->photos = $photos;
        $this->price = $price;
        $this->description = $description;
        $this->quantity = $quantity;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->category_id = $category_id;
    }

    // Getters and Setters for all properties
    public function getCategoryId() {
        return $this->category_id;
    }

    public function setCategoryId($category_id) {
        $this->category_id = $category_id;
    }

    // New method to fetch the associated category
    public function getCategory() {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM category WHERE id = :id");
        $stmt->bindParam(':id', $this->category_id, PDO::PARAM_INT);
        $stmt->execute();
        $categoryData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($categoryData) {
            return new Category(
                $categoryData['id'],
                $categoryData['name'],
                $categoryData['description'],
                $categoryData['createdAt'],
                $categoryData['updatedAt']
            );
        }

        return null; // In case no category is found
    }
}
