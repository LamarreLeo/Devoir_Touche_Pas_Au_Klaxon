<?php
declare(strict_types=1);

namespace Model;

use PDO;

class Trajet
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Lister tous les trajets
     */
    public function findAll(): array
    {
        $stmt = $this->pdo->query("
                SELECT
                    t.id,
                    t.user_id,
                    t.date_heure_depart,
                    t.date_heure_arrivee,
                    t.places,
                    u.nom AS user_nom,
                    u.prenom AS user_prenom,
                    u.phone AS user_phone,
                    u.email AS user_email,
                    a1.ville AS agence_depart,
                    a2.ville AS agence_arrivee
                FROM trajets t
                JOIN users u ON t.user_id = u.id
                JOIN agences a1 ON t.agence_depart_id = a1.id
                JOIN agences a2 ON t.agence_arrivee_id = a2.id
                ORDER BY t.date_heure_depart ASC
            ");
        
        return $stmt->fetchAll();
    }

    /**
     * Récupérer un trajet par son ID
     */
    public function findById(int $id): ?array
    {
        $stmt = $this->pdo->prepare("
            SELECT *
            FROM trajets
            WHERE id = :id
        ");

        $stmt->execute(['id' => $id]);

        $trajet = $stmt->fetch();

        return $trajet ?: null;
    }

    /**
     * Créer un trajet
     */
    public function create(
        int $userId,
        int $agenceDepartId,
        int $agenceArriveeId,
        string $dateHeureDepart,
        string $dateHeureArrivee,
        int $places
    ): bool {
        $stmt = $this->pdo->prepare("
            INSERT INTO trajets (
                user_id,
                agence_depart_id,
                agence_arrivee_id,
                date_heure_depart,
                date_heure_arrivee,
                places
            ) VALUES (
                :user_id,
                :agence_depart_id,
                :agence_arrivee_id,
                :date_heure_depart,
                :date_heure_arrivee,
                :places
            )
        ");

        return $stmt->execute([
            'user_id'            => $userId,
            'agence_depart_id'   => $agenceDepartId,
            'agence_arrivee_id'  => $agenceArriveeId,
            'date_heure_depart'  => $dateHeureDepart,
            'date_heure_arrivee' => $dateHeureArrivee,
            'places'              => $places
        ]);
    }

    /**
     * Modifier un trajet par son ID
     */
    public function update(
        int $id,
        int $agenceDepartId,
        int $agenceArriveeId,
        string $dateHeureDepart,
        string $dateHeureArrivee,
        int $places
    ): bool {
        $stmt = $this->pdo->prepare("
            UPDATE trajets
            SET agence_depart_id = :agence_depart_id,
                agence_arrivee_id = :agence_arrivee_id,
                date_heure_depart = :date_heure_depart,
                date_heure_arrivee = :date_heure_arrivee,
                places = :places
            WHERE id = :id
        ");

        return $stmt->execute([
            'id' => $id,
            'agence_depart_id' => $agenceDepartId,
            'agence_arrivee_id' => $agenceArriveeId,
            'date_heure_depart' => $dateHeureDepart,
            'date_heure_arrivee' => $dateHeureArrivee,
            'places' => $places
        ]);
    }

    /**
     * Supprimer un trajet par son ID
     */
    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare("
            DELETE FROM trajets
            WHERE id = :id
        ");

        return $stmt->execute(['id' => $id]);
    }
}