<?php
declare(strict_types= 1);

namespace Model;

use PDO;

class User
{
    private $pdo;
    
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Récupère un utilisateur par son ID
     */
    public function findById(int $id): ?array
    {
        $stmt = $this->pdo->prepare("
            SELECT *
            FROM users 
            WHERE id = :id
        ");

        $stmt->execute(['id' => $id]);
        
        $user = $stmt->fetch();
        
        return $user ?: null;
    }

    /**
     * Récupère un utilisateur par son email
     */
    public function findByEmail(string $email): ?array
    {
        $stmt = $this->pdo->prepare("
            SELECT * 
            FROM users 
            WHERE email = :email
        ");

        $stmt->execute(['email' => $email]);
        
        $user = $stmt->fetch();
        
        return $user ?: null;
    }

    /**
     * Vérifie le mot de passe d'un utilisateur
     */
    public function verifyPassword(string $plainPassword, string $hashedPassword): bool
    {
        return password_verify($plainPassword, $hashedPassword);
    }

    /**
     * Liste tous les utilisateurs
     */
    public function findAll(): array
    {
        $stmt = $this->pdo->query('SELECT * FROM users ORDER BY nom ASC');
        
        return $stmt->fetchAll();
    }
}