<?php

namespace src\Controleurs;

use src\UsersStory\CreateAccount;

class
InscriptionControleur
{
    private CreateAccount $createAccount;

    public function __construct(CreateAccount $createAccount)
    {
        $this->createAccount = $createAccount;
    }

    public function creer()
    {
        try {
            // Récupérer les données du formulaire
            $pseudo = $_POST['pseudo'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            // Tenter de créer le compte
            $user = $this->createAccount->execute($pseudo, $email, $password);

            // Si la création réussit
            $_SESSION['success'] = "Compte créé avec succès !";
            // Redirection vers l'accueil
            header('Location: /index.php?route=accueil');
            exit;

        } catch (\InvalidArgumentException $e) {
            // Stocker le message d'erreur dans la session
            $_SESSION['error'] = $e->getMessage();

            // Stocker les données du formulaire pour les réafficher
            $_SESSION['form_data'] = [
                'pseudo' => $pseudo,
                'email' => $email
            ];

            // Rediriger vers le formulaire
            header('Location: /index.php?route=creercompte');
            exit;
        }
    }
    private function creerSession($user): void
    {
        $_SESSION['user'] = [
            'id' => $user->getId(),
            'pseudo' => $user->getPseudo(),
            'email' => $user->getEmail()
        ];
    }
}