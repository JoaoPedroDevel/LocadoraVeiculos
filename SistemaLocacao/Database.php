<?php

class Database {
    private static $dbHost = 'localhost';
    private static $dbName = 'locadora_veiculos';
    private static $dbUser = 'root';
    private static $dbPass = '';
    private static $pdo;

    // Conectar ao banco de dados
    public static function connect() {
        if (self::$pdo == null) {
            try {
                self::$pdo = new PDO(
                    "mysql:host=" . self::$dbHost . ";dbname=" . self::$dbName,
                    self::$dbUser,
                    self::$dbPass
                );
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Falha na conexão: " . $e->getMessage());
            }
        }
        return self::$pdo;
    }

    // Fechar a conexão
    public static function disconnect() {
        self::$pdo = null;
    }
}
?>
