<?php

namespace src\UsersStory;

use Doctrine\ORM\EntityManager;
use src\Entity\User;

class CreateAccount
{
    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager) {
        $this->entityManager = $entityManager;
    }

    public function execute(string $pseudo, string $email, string $password): User
    {
        // Vérifier que les données sont présentes
        if (empty($pseudo) || empty($email) || empty($password)) {
            throw new \InvalidArgumentException("Tous les champs (pseudo, email, mot de passe) doivent être renseignés.");
        }

        // Vérifier si l'email est valide
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException("L'adresse email fournie n'est pas valide.");
        }

        // Vérifier la longueur du pseudo
        if (strlen($pseudo) < 2 || strlen($pseudo) > 50) {
            throw new \InvalidArgumentException("Le pseudo doit contenir entre 2 et 50 caractères.");
        }

        // Vérifier si le mot de passe est sécurisé
        if (strlen($password) < 8) {
            throw new \InvalidArgumentException("Le mot de passe doit contenir au moins 8 caractères.");
        }

        // Vérifier que l'email n'existe pas déjà
        $existingUser = $this->entityManager->getRepository(User::class)->findOneBy(['email' => $email]);
        if ($existingUser !== null) {
            throw new \InvalidArgumentException("L'adresse email est déjà utilisée par un autre compte.");
        }

        // 1. Hacher le mot de passe
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // 2. Créer une instance de la classe User
        $user = new User();
        $user->setPseudo($pseudo);
        $user->setEmail($email);
        $user->setPassword($hashedPassword);

        // 3. Persister l'utilisateur
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $user;
    }
}