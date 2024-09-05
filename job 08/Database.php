<?php

class Database {
    private static $host = '127.0.0.1';  // Remplacez par votre hôte
    private static $dbName = 'draft-shop';  // Remplacez par votre nom de base de données
    private static $username = 'root';  // Remplacez par votre nom d'utilisateur MySQL
    private static $password = '';  // Remplacez par votre mot de passe MySQL
    private static $connection = null;

    // Méthode pour obtenir une connexion à la base de données
    public static function getConnection() {
        if (self::$connection === null) {
            try {
                // Connexion avec PDO
                self::$connection = new PDO("mysql:host=" . self::$host . ";dbname=" . self::$dbName, self::$username, self::$password);
                // Définir le mode d'erreur à Exception
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                // En cas d'erreur, on affiche le message
                die("Erreur de connexion à la base de données : " . $e->getMessage());
            }
        }
        return self::$connection;
    }
}
