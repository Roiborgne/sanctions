<?php

namespace src\UsersStory;

use Doctrine\ORM\EntityManager;
use src\Entity\User;

class Login
{
    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager) {
        $this->entityManager = $entityManager;
    }

    public function execute(string $email, string $password): User
    {
        if (empty($email)) {
            throw new \InvalidArgumentException("L'email est requis.");
        }
        if (empty($password)) {
            throw new \InvalidArgumentException("Le mot de passe est requis.");
        }

        // Recherche de l'utilisateur par email
        $user = $this->entityManager->getRepository(User::class)
            ->findOneBy(['email' => $email]);

        if (!$user) {
            throw new \InvalidArgumentException("Identifiants incorrects.");
        }

        // Vérification du mot de passe
        if (!password_verify($password, $user->getPassword())) {
            throw new \InvalidArgumentException("Identifiants incorrects.");
        }

        return $user;
    }
}