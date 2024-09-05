<?php
require_once 'Database.php';
require_once 'Product.php';

class Category {
    private $id;
    private $name;
    private $description;
    private $createdAt;
    private $updatedAt;

    // Constructeur pour initialiser les propriétés de la catégorie
    public function __construct($id = null) {
        if ($id !== null) {
            $this->findOneById($id);
        }
    }

    // Hydrate l'objet Category avec un tableau de données
    public function hydrate($data) {
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->description = $data['description'];
        $this->createdAt = $data['createdAt'];
        $this->updatedAt = $data['updatedAt'];
    }

    // Méthode pour trouver une catégorie par son ID et hydrater l'instance actuelle
    public function findOneById(int $id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM category WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $category = $stmt->fetch();

        if ($category) {
            $this->hydrate($category);
            return $this; // Retourner l'instance courante hydratée
        } else {
            return false; // Retourner false si la catégorie n'existe pas
        }
    }

    // Méthode pour récupérer tous les produits associés à cette catégorie
    public function getProducts() {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM product WHERE category_id = :category_id");
        $stmt->execute(['category_id' => $this->id]);
        $products = $stmt->fetchAll();

        $productObjects = [];
        foreach ($products as $productData) {
            $product = new Product();
            $product->hydrate($productData);
            $productObjects[] = $product;
        }

        return $productObjects;
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
