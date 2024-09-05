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

    // Constructeur vide pour instancier l'objet sans avoir besoin d'un ID au départ
    public function __construct($id = null) {
        if ($id !== null) {
            $this->findOneById($id);
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

    // Méthode pour trouver un produit par son ID et hydrater l'instance actuelle
    public function findOneById(int $id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM product WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $product = $stmt->fetch();

        if ($product) {
            $this->hydrate($product);
            return $this; // Retourner l'instance courante hydratée
        } else {
            return false; // Retourner false si le produit n'existe pas
        }
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
