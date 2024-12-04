<?php

namespace App\UsersStory;

use App\Entity\Users;
use Doctrine\ORM\EntityManager;

class Login
{
    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager) {
        $this->entityManager = $entityManager;
    }

    public function execute(string $email, string $password)
    {
        if (empty($email)) {
            throw new \InvalidArgumentException("L'email est requis.");
        }
        if (empty($password)) {
            throw new \InvalidArgumentException("Le mot de passe est requis.");
        }

        // Recherche de l'utilisateur par email
        $user = $this->entityManager->getRepository(Users::class)
            ->findOneBy(['email' => $email]);

        if (!$user) {
            throw new \InvalidArgumentException("Identifiants incorrects.");
        }

        // Vérification du mot de passe
        if (!password_verify($password, $user->getPassword())) {
            throw new \InvalidArgumentException("Identifiants incorrects.");
        }
        $_SESSION['user'] = [
            'id' => $user->getId(),
            'nom' => $user->getNom(),
            'prenom' => $user->getPrenom(),
            'email' => $user->getEmail()
        ];
    }
}