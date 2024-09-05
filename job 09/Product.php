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

    // Constructeur pour initialiser les propriétés du produit
    public function __construct($id = null, $name, $photos, $price, $description, $quantity, $createdAt, $updatedAt, $category_id) {
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

    // Méthode pour créer un nouveau produit en base de données
    public function create() {
        $db = Database::getConnection();
        
        $sql = "INSERT INTO product (name, photos, price, description, quantity, createdAt, updatedAt, category_id) 
                VALUES (:name, :photos, :price, :description, :quantity, :createdAt, :updatedAt, :category_id)";

        $stmt = $db->prepare($sql);

        // Bind des paramètres
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':photos', json_encode($this->photos)); // Encode en JSON le tableau des photos
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':quantity', $this->quantity);
        $stmt->bindParam(':createdAt', $this->createdAt->format('Y-m-d H:i:s'));
        $stmt->bindParam(':updatedAt', $this->updatedAt->format('Y-m-d H:i:s'));
        $stmt->bindParam(':category_id', $this->category_id);

        if ($stmt->execute()) {
            // Récupérer le dernier ID inséré
            $this->id = $db->lastInsertId();
            return $this; // Retourne l'instance actuelle avec l'ID mis à jour
        } else {
            return false; // Retourne false si l'insertion échoue
        }
    }
}
