<?php
declare(strict_types=1);

namespace Controller;

use Model\Trajet;

use Core\View;

use PDO;

class TrajetController
{
    private Trajet $trajetModel;
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
        $this->trajetModel = new Trajet($pdo);
    }

    /**
     * Affiche la liste des trajets
     */
    public function index(): void
    {
        $trajets = $this->trajetModel->findAll();

        View::render('trajets/index', [
            'trajets' => $trajets
        ]);
    }

    /**
     * Affiche les détail d'un trajet
     */
    public function show(int $id): void
    {
        $trajet = $this->trajetModel->findById($id);

        if (!$trajet) {
            http_response_code(404);
            echo 'Trajet introuvable';
            return;
        }

        View::render('trajets/show', [
            'trajet' => $trajet,
        ]);
    }

    /**
     * Créer un trajet
     */
    public function create(): void
    {
        $agenceModel = new \Model\Agence($this->pdo);
        $agences = $agenceModel->findAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'user_id' => (int)($_POST['user_id'] ?? 0),
                'agence_depart_id' => (int)($_POST['agence_depart_id'] ?? 0),
                'agence_arrivee_id' => (int)($_POST['agence_arrivee_id'] ?? 0),
                'date_heure_depart' => $_POST['date_heure_depart'] ?? '',
                'date_heure_arrivee' => $_POST['date_heure_arrivee'] ?? '',
                'places' => (int)($_POST['places'] ?? 0)
            ];

            $errors = $this->validateTrajetData($data);

            if (empty($errors)) {
                $success = $this->trajetModel->create(
                    $data['user_id'],
                    $data['agence_depart_id'],
                    $data['agence_arrivee_id'],
                    $data['date_heure_depart'],
                    $data['date_heure_arrivee'],
                    $data['places']
                );

                if ($success) {
                    header('Location: /trajets');
                    exit;
                } else {
                    $errors[] = 'Erreur lors de la création du trajet';
                }
            }

            View::render('trajets/create', [
                'agences' => $agences,
                'errors' => $errors,
                'data' => $data
            ]);
        } else {
            View::render('trajets/create', [
                'agences' => $agences,
                'errors' => [],
                'data' => []
            ]);
        }
    }

    /**
     * Modifie un trajet
     */
    public function edit(int $id): void
    {
        $trajet = $this->trajetModel->findById($id);

        if (!$trajet) {
            http_response_code(404);
            echo 'Trajet introuvable';
            return;
        }

        $agenceModel = new \Model\Agence($this->pdo);
        $agences = $agenceModel->findAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'agence_depart_id' => (int)($_POST['agence_depart_id'] ?? 0),
                'agence_arrivee_id' => (int)($_POST['agence_arrivee_id'] ?? 0),
                'date_heure_depart' => $_POST['date_heure_depart'] ?? '',
                'date_heure_arrivee' => $_POST['date_heure_arrivee'] ?? '',
                'places' => (int)($_POST['places'] ?? 0)
            ];

            $errors = $this->validateTrajetData($data);

            if (empty($errors)) {
                $success = $this->trajetModel->update(
                    $id,
                    $data['agence_depart_id'],
                    $data['agence_arrivee_id'],
                    $data['date_heure_depart'],
                    $data['date_heure_arrivee'],
                    $data['places']
                );

                if ($success) {
                    header('Location: /trajets');
                    exit;
                } else {
                    $errors[] = 'Erreur lors de la modification du trajet';
                }
            }

            View::render('trajets/edit', [
                'trajet' => $trajet,
                'agences' => $agences,
                'errors' => $errors,
                'data' => array_merge($trajet, $data)
            ]);
        } else {
            View::render('trajets/edit', [
                'trajet' => $trajet,
                'agences' => $agences,
                'errors' => [],
                'data' => $trajet
            ]);
        }
    }

    /**
     * Valide les données du trajet
     */
    private function validateTrajetData(array $data): array
    {
        $errors = [];

        if ($data['user_id'] <= 0) {
            $errors[] = 'L\'utilisateur est requis';
        }

        if ($data['agence_depart_id'] <= 0) {
            $errors[] = 'L\'agence de départ est requise';
        }

        if ($data['agence_arrivee_id'] <= 0) {
            $errors[] = 'L\'agence d\'arrivée est requise';
        }

        if ($data['agence_depart_id'] === $data['agence_arrivee_id']) {
            $errors[] = 'Les agences de départ et d\'arrivée doivent être différentes';
        }

        if (empty($data['date_heure_depart'])) {
            $errors[] = 'La date de départ est requise';
        }

        if (empty($data['date_heure_arrivee'])) {
            $errors[] = 'La date d\'arrivée est requise';
        }

        if ($data['date_heure_depart'] >= $data['date_heure_arrivee']) {
            $errors[] = 'La date d\'arrivée doit être postérieure à la date de départ';
        }

        if ($data['places'] <= 0 || $data['places'] > 10) {
            $errors[] = 'Le nombre de places doit être entre 1 et 10';
        }

        return $errors;
    }

    /**
     * Supprime un trajet
     */
    public function delete(int $id): void
    {
        $trajet = $this->trajetModel->findById($id);

        if (!$trajet) {
            http_response_code(404);
            echo 'Trajet introuvable';
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $success = $this->trajetModel->delete($id);

            if ($success) {
                header('Location: /trajets');
                exit;
            } else {
                http_response_code(500);
                echo 'Erreur lors de la suppression du trajet';
                return;
            }
        } else {
            View::render('trajets/delete', [
                'trajet' => $trajet
            ]);
        }
    }
}