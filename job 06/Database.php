<?php

class Database {
    private static $instance = null;

    public static function getConnection() {
        if (self::$instance === null) {
            try {
                $host = 'localhost'; // Modifier selon votre configuration
                $db = 'draft-shop';   // Le nom de votre base de données
                $user = 'root';       // L'utilisateur (par défaut 'root')
                $pass = '';           // Le mot de passe (vide pour Laragon/XAMPP)
                $charset = 'utf8mb4';

                $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
                $options = [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                ];

                self::$instance = new PDO($dsn, $user, $pass, $options);
            } catch (PDOException $e) {
                throw new Exception("Erreur de connexion : " . $e->getMessage());
            }
        }

        return self::$instance;
    }
}
