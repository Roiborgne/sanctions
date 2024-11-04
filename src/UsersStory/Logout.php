<?php

namespace src\UsersStory;

class Logout
{
    public function execute(): void
    {
        // Détruire toutes les données de session
        session_unset();
        session_destroy();
    }
}