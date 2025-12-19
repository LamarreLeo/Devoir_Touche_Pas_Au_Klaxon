<?php
declare(strict_types=1);

namespace Controller;

use Model\Agence;

use Core\View;

use PDO;

class AgenceController
{
    private Agence $agenceModel;
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
        $this->agenceModel = new Agence($pdo);
    }

    /**
     * Affiche la liste des agences
     */
    public function index(): void
    {
        $agences = $this->agenceModel->findAll();

        View::render('agences/index', [
            'agences' => $agences
        ]);
    }

    /**
     * Affiche les détails d'une agence
     */
    public function show(int $id): void
    {
        $agence = $this->agenceModel->findById($id);

        if (!$agence) {
            http_response_code(404);
            echo 'Agence introuvable';
            return;
        }

        View::render('agences/show', [
            'agence' => $agence,
        ]);
    }

    /**
     * Créer une agence
     */
    public function create(): void
    {
        // Vérifier que l'utilisateur est connecté et admin
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            http_response_code(403);
            echo 'Accès non autorisé';
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'ville' => trim($_POST['ville'] ?? '')
            ];

            $errors = $this->validateAgenceData($data);

            if (empty($errors)) {
                $success = $this->agenceModel->create($data['ville']);

                if ($success) {
                    header('Location: /Devoir_Touche_Pas_Au_Klaxon/PHP/public/agences');
                    exit;
                } else {
                    $errors[] = 'Erreur lors de la création de l\'agence';
                }
            }

            View::render('agences/create', [
                'errors' => $errors,
                'data' => $data
            ]);
        } else {
            View::render('agences/create', [
                'errors' => [],
                'data' => []
            ]);
        }
    }

    /**
     * Modifie une agence
     */
    public function edit(int $id): void
    {
        // Vérifier que l'utilisateur est connecté et admin
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            http_response_code(403);
            echo 'Accès non autorisé';
            return;
        }

        $agence = $this->agenceModel->findById($id);

        if (!$agence) {
            http_response_code(404);
            echo 'Agence introuvable';
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'ville' => trim($_POST['ville'] ?? '')
            ];

            $errors = $this->validateAgenceData($data);

            if (empty($errors)) {
                $success = $this->agenceModel->update($id, $data['ville']);

                if ($success) {
                    header('Location: /Devoir_Touche_Pas_Au_Klaxon/PHP/public/agences');
                    exit;
                } else {
                    $errors[] = 'Erreur lors de la modification de l\'agence';
                }
            }

            View::render('agences/edit', [
                'agence' => $agence,
                'errors' => $errors,
                'data' => array_merge($agence, $data)
            ]);
        } else {
            View::render('agences/edit', [
                'agence' => $agence,
                'errors' => [],
                'data' => $agence
            ]);
        }
    }

    /**
     * Supprime une agence
     */
    public function delete(int $id): void
    {
        // Vérifier que l'utilisateur est connecté et admin
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            http_response_code(403);
            echo 'Accès non autorisé';
            return;
        }

        // Vérifier que c'est bien une requête POST 
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo 'Méthode non autorisée';
            return;   
        }

        $agence = $this->agenceModel->findById($id);

        if (!$agence) {
            http_response_code(404);
            echo 'Agence introuvable';
            return;
        }

        // Supprimer l'agence
        $success = $this->agenceModel->delete($id);

        if ($success) {
            // Redirection vers la liste des agences
            header('Location: /Devoir_Touche_Pas_Au_Klaxon/PHP/public/agences');
            exit;
        } else {
            http_response_code(500);
            echo 'Erreur lors de la suppression de l\'agence';
            return;
        }
    }

    /**
     * Valide les données de l'agence
     */
    private function validateAgenceData(array $data): array
    {
        $errors = [];

        if (empty($data['ville'])) {
            $errors[] = 'Le nom de la ville est requis';
        }

        if (strlen($data['ville']) < 2) {
            $errors[] = 'Le nom de la ville doit contenir au moins 2 caractères';
        }

        if (strlen($data['ville']) > 100) {
            $errors[] = 'Le nom de la ville ne peut pas dépasser 100 caractères';
        }

        return $errors;
    }
}
