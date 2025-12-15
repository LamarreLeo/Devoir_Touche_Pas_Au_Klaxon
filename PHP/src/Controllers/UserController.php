<?php
declare(strict_types=1);

namespace Controller;

use Model\User;

use Core\View;

use PDO;

class UserController
{
    private User $userModel;
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
        $this->userModel = new User($pdo);
    }

    /**
     * Affiche la liste des utilisateurs
     */
    public function index(): void
    {
        $users = $this->userModel->findAll();

        View::render('users/index', [
            'users' => $users
        ]);
    }

    /**
     * Affiche les détails d'un utilisateur
     */
    public function show(int $id): void
    {
        $user = $this->userModel->findById($id);

        if (!$user) {
            http_response_code(404);
            echo 'Utilisateur introuvable';
            return;
        }

        View::render('users/show', [
            'user' => $user,
        ]);
    }

    /**
     * Affiche le profil d'un utilisateur par email
     */
    public function profile(string $email): void
    {
        $user = $this->userModel->findByEmail($email);

        if (!$user) {
            http_response_code(404);
            echo 'Utilisateur introuvable';
            return;
        }

        View::render('users/profile', [
            'user' => $user,
        ]);
    }

    /**
     * Connecte un utilisateur
     */
    public function login(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            header('Location: /login');
            exit;
        }

        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $user = $this->userModel->findByEmail($email);

        if ($user && $this->userModel->verifyPassword($password, $user['password'])) {
            // Connexion réussie
            $_SESSION['user'] = [
                'id' => $user['ìd'],
                'email' => $user['email'],
                'nom' => $user['nom'],
                'prenom' => $user['prenom'],
                'role' => $user['role']
            ];
            header('Location: /');
            exit;
        } else {
            // Échec de connexion
            View::render('users/login', [
                'error' => 'Email ou mot de passe incorrect',
                'email' => $email
            ]);
        }
    }

    /**
     * Affiche le formulaire de connexion
     */
    public function showLoginForm(): void
    {
        // Si déjà connecté, rediriger vers l'accueil
        if (isset($_SESSION['user'])) {
            header('location: /');
            exit;
        }
        
        View::render('users/login', [
            'error' => '',
            'email' => ''
        ]);
    }

    /**
     * Déconnexion de l'utilisateur
     */
    public function logout(): void
    {
        // Détruit toutes les données de session
        $_SESSION = [];

        // Détruit la session
        session_destroy();

        header('Location: /');
        exit;
    }
}
