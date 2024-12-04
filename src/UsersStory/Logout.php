<?php

namespace App\UsersStory;

class Logout
{
    public function execute(): void
    {
        //unset($_SESSION["user"]);
        // Détruire toutes les données de session
        session_unset();
        session_destroy();
    }
}