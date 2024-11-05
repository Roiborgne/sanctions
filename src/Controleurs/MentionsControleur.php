<?php

namespace App\Controleurs;

class MentionsControleur
{
    // Méthode permettant de gérer la page d'accueil
    public function mentions()
    {
        // Fait appel à la vue afin de renvoyé la page
        require_once __DIR__ . "/../../views/mentions.php";
    }

}