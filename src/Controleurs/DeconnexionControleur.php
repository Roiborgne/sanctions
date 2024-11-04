<?php

namespace src\Controleurs;
use src\UsersStory\Logout;

class DeconnexionControleur
{
    private Logout $logout;

    public function __construct(Logout $logoutUser)
    {
        $this->logout = $logoutUser;
    }

    public function deconnecter()
    {
        // Exécuter la déconnexion
        $this->logout->execute();

        // Démarrer une nouvelle session pour les messages flash
        session_start();

        // Ajouter un message de succès
        $_SESSION['success'] = "Vous avez été déconnecté avec succès !";

        // Rediriger vers la page de connexion
        header('Location: /index.php');
        exit;
    }
}