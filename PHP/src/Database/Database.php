<?php
declare(strict_types=1);

namespace Database;

use PDO;
use PDOException;

class Database 
{
    private PDO $pdo;

    public function __construct(array $config)
    {
        $db = $config["db"];
        $dsn = "mysql:host={$db['host']};port={$db['port']};dbname={$db['dbname']};charset={$db['charset']}";

        try {
            $this->pdo = new PDO($dsn, $config["user"], $config["pass"], [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    public function getConnection(): PDO
    {
        return $this->pdo;
    }
}