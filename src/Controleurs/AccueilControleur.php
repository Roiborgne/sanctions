<?php

namespace src\Controleurs;
class AccueilControleur
{
    // Méthode permettant de gérer la page d'accueil
    public function accueil() {
        // Fait appel à la vue afin de renvoyé la page
        require_once __DIR__ . "/../../views/accueil/accueil.php";
    }
}