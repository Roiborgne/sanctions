<?php

namespace App\UsersStory;

use App\Entity\Users;
use Doctrine\ORM\EntityManager;

class CreateAccount
{
    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager) {
        $this->entityManager = $entityManager;
    }

    public function execute(string $nom, string $prenom, string $email, string $password, string $confpassword): Users
    {
        // Vérifier que les données sont présentes
        if (empty($nom) || empty($prenom) || empty($email) || empty($password)) {
            throw new \InvalidArgumentException("Tous les champs (nom, prenom, email, mot de passe) doivent être renseignés.");
        }

        // Vérifier si l'email est valide
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException("L'adresse email fournie n'est pas valide.");
        }

        // Vérifier la longueur du nom
        if (strlen($nom) < 2 || strlen($nom) > 50) {
            throw new \InvalidArgumentException("Le nom doit contenir entre 2 et 50 caractères.");
        }

        // Vérifier la longueur du nom
        if (strlen($prenom) < 2 || strlen($prenom) > 50) {
            throw new \InvalidArgumentException("Le prenom doit contenir entre 2 et 50 caractères.");
        }

        // Vérifier si le mot de passe est sécurisé
        //if (strlen($password) < 8) { # ||  !ctype_alpha($password) ||  ctype_lower($password) || !ctype_alnum($password)
        //    throw new \InvalidArgumentException("Le mot de passe doit contenir au moins 8 caractères,");
        //} # dont une lettre majuscule, une lettre minuscule, un chiffre et un caractère spécial.


        if (strlen($password) < 8) {
            throw new \InvalidArgumentException("Le mot de passe doit contenir au moins 8 caractères.");
        }

        if ($password !== $confpassword) {
            throw new \InvalidArgumentException("Les mots de passe ne correspondent pas.");
        }

        // Vérifier que l'email n'existe pas déjà
        $existingUser = $this->entityManager->getRepository(Users::class)->findOneBy(['email' => $email]);
        if ($existingUser !== null) {
            throw new \InvalidArgumentException("L'adresse email est déjà utilisée par un autre compte.");
        }

        // 1. Hacher le mot de passe
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // 2. Créer une instance de la classe Users
        $user = new Users();
        $user->setNom($nom);
        $user->setPrenom($prenom);
        $user->setEmail($email);
        $user->setPassword($hashedPassword);

        // 3. Persister l'utilisateur
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $user;
    }
}