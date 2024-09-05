<?php
require_once 'Database.php';
require_once 'Product.php';

class Category {
    private $id;
    private $name;
    private $description;
    private $createdAt;
    private $updatedAt;

    // Constructeur avec des paramètres optionnels
    public function __construct($id = null, $name = null, $description = null, $createdAt = null, $updatedAt = null) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    // Getters et setters
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getCreatedAt() {
        return $this->createdAt;
    }

    public function setCreatedAt($createdAt) {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt() {
        return $this->updatedAt;
    }

    public function setUpdatedAt($updatedAt) {
        $this->updatedAt = $updatedAt;
    }

    // Récupère tous les produits liés à cette catégorie
    public function getProducts() {
        $db = Database::getConnection();

        $sql = "SELECT * FROM product WHERE category_id = :category_id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':category_id', $this->id, PDO::PARAM_INT);
        $stmt->execute();

        $products = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $product = new Product();
            $product->hydrate($row); // Utilisation d'une méthode hydrate dans la classe Product
            $products[] = $product;
        }

        return $products;
    }

    // Méthode pour récupérer une catégorie par son ID
    public static function findOneById($id) {
        $db = Database::getConnection();

        $sql = "SELECT * FROM category WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new Category($row['id'], $row['name'], $row['description'], $row['createdAt'], $row['updatedAt']);
        }

        return false;
    }
}
