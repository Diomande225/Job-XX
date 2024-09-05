<?php
require_once 'Database.php';

try {
    $db = Database::getConnection();
    echo "Connexion réussie à la base de données !";
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
}
