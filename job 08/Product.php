<?php
require_once 'Database.php';

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

    // Constructor
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

    // Method to find all products
    public static function findAll() {
        $db = Database::getConnection();
        $query = $db->query('SELECT * FROM product');
        $products = [];

        // Fetch each row and create a Product instance
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $products[] = new Product(
                $row['id'],
                $row['name'],
                $row['photos'],
                $row['price'],
                $row['description'],
                $row['quantity'],
                $row['createdAt'],
                $row['updatedAt'],
                $row['category_id']
            );
        }

        return $products;  // Return the array of Product instances
    }

    // Getters and Setters (Add them as needed)
}
