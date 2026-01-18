<?php
namespace app\controllers;

use app\config\Database;
use app\models\managers\AdministrateurManager;

class AuthController {

    public function login() {
        // Est-ce que le formulaire a été envoyé ?
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            // On nettoie les entrées
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'] ?? '';

            // On initialise nos outils
            $db = Database::getInstance();
            $manager = new AdministrateurManager($db);

            // On demande au Manager de chercher l'admin
            $admin = $manager->getByEmail($email);

            // On vérifie si l'admin existe ET si le mot de passe est bon
            if ($admin && $admin->verifierMotDePasse($password)) {
                
                // SUCCÈS : On remplit la session
                $_SESSION['admin_id'] = $admin->getIdAdmin();
                $_SESSION['admin_email'] = $admin->getEmail();

                // On redirige vers le dashboard
                header('Location: index.php?page=dashboard');
                exit();
            } else {
                // ÉCHEC : On renvoie un message d'erreur à la vue
                return "Identifiants incorrects. Veuillez réessayer.";
            }
        }
        return null;
    }

    // Déconnecte l'administrateur
    public function logout() {
        session_destroy();
        header('Location: index.php?page=home');
        exit();
    }
}