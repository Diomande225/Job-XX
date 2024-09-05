<?php
class Database {
    private static $host = 'localhost';  // Votre serveur MySQL
    private static $dbName = 'draft-shop';  // Le nom de votre base de données
    private static $username = 'root';  // Votre nom d'utilisateur MySQL (par défaut 'root' pour Laragon)
    private static $password = '';  // Votre mot de passe MySQL (généralement vide par défaut sur Laragon)
    private static $connection = null;

    public static function getConnection() {
        if (self::$connection === null) {
            try {
                // Créer une nouvelle connexion PDO
                self::$connection = new PDO("mysql:host=" . self::$host . ";dbname=" . self::$dbName, self::$username, self::$password);
                // Définir le mode d'erreur de PDO sur Exception
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die('Erreur de connexion à la base de données : ' . $e->getMessage());
            }
        }
        return self::$connection;
    }
}
