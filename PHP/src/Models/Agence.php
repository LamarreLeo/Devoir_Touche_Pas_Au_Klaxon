<?php
declare(strict_types=1);

namespace Model;

use PDO;

class Agence
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Lister toutes les agences
     */
    public function findAll(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM agences ORDER BY ville ASC");
        
        return $stmt->fetchAll();
    }

    /**
     * Récupérer une agence par son ID
     */
    public function findById(int $id): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM agences WHERE id = :id");
        
        $stmt->execute(['id' => $id]);
        
        $agence = $stmt->fetch();
        
        return $agence ?: null;
    }

    /**
     * Créer une agence
     */
    public function create(string $ville): bool
    {
        $stmt = $this->pdo->prepare("INSERT INTO agences (ville) VALUES (:ville)");

        return $stmt->execute(['ville' => $ville]);
    }

    /**
     * Modifier une agence par son ID
     */
    public function update(int $id, string $ville): bool
    {
        $stmt = $this->pdo->prepare("UPDATE agences SET ville = :ville WHERE id = :id");

        return $stmt->execute(['id' => $id, 'ville' => $ville]);
    }

    /**
     * Supprimer une agence par son ID
     */
    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM agences WHERE id = :id");

        return $stmt->execute(['id' => $id]);
    }
}