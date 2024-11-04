<?php

namespace src\Controleurs;

use src\UsersStory\Login;

class ConnexionControleur
{
    private Login $loginUser;

    public function __construct(Login $loginUser)
    {
        $this->loginUser = $loginUser;
    }

    public function connecter()
    {
        try {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $user = $this->loginUser->execute($email, $password);

            // Stockage des informations de l'utilisateur en session
            $this->creerSession($user);

            $_SESSION['success'] = "Connexion réussie !";
            header('Location: /index.php?route=accueil');
            exit;

        } catch (\InvalidArgumentException $e) {
            $_SESSION['error'] = $e->getMessage();
            $_SESSION['form_data'] = [
                'email' => $email
            ];
            header('Location: /index.php?route=connexion');
            exit;
        }
    }

    // Méthode pour créer la session utilisateur
    private function creerSession($user): void
    {
        $_SESSION['user'] = [
            'id' => $user->getId(),
            'pseudo' => $user->getPseudo(),
            'email' => $user->getEmail()
        ];
    }
}