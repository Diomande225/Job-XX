<?php
class Database {
    private static $connection = null;

    public static function getConnection() {
        if (self::$connection === null) {
            try {
                $host = 'localhost'; // Hôte
                $dbname = 'your_database'; // Nom de la base de données
                $username = 'your_db_user'; // Nom d'utilisateur
                $password = 'your_db_password'; // Mot de passe
                self::$connection = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Database connection error: " . $e->getMessage());
            }
        }
        return self::$connection;
    }
}
