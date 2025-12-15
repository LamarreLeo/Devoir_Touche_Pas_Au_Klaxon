<?php
declare(strict_types=1);

namespace Controller;

use Model\Trajet;

use Core\View;

use PDO;

class TrajetController
{
    private Trajet $trajetModel;

    public function __construct(PDO $pdo)
    {
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
}