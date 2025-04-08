<?php

namespace App\UsersStory;

use App\Entity\Sanctions;
use App\Entity\Etudiants;
use App\Entity\Users;
use Doctrine\ORM\EntityManager;

class CreateSanction
{
    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function ajouterSanction(
        int    $etudiantId,
        string $nomProfesseur,
        string $motif,
        string $description,
        string $dateIncident,
        int    $createurId
    ): Sanctions
    {
        // Validation
        if (empty($etudiantId) || empty($nomProfesseur) || empty($motif) || empty($description) || empty($dateIncident)) {
            throw new \InvalidArgumentException("Tous les champs doivent être remplis.");
        }

        if (!strtotime($dateIncident)) {
            throw new \InvalidArgumentException("La date de l'incident est invalide.");
        }

        // Vérifie si l'étudiant et l'utilisateur (createur) existent
        $etudiant = $this->entityManager->getRepository(Etudiants::class)->find($etudiantId);
        if (!$etudiant) {
            throw new \InvalidArgumentException("Étudiant non trouvé.");
        }

        $createur = $this->entityManager->getRepository(Users::class)->find($createurId);
        if (!$createur) {
            throw new \InvalidArgumentException("Utilisateur créateur non trouvé.");
        }

        // Création de la sanction
        $sanction = new Sanctions();
        $sanction->setEtudiant($etudiant);
        $sanction->setNomProfesseur($nomProfesseur);
        $sanction->setMotif($motif);
        $sanction->setDescription($description);
        $sanction->setDateIncident(new \DateTime($dateIncident));
        $sanction->setDateCreation(new \DateTime());
        $sanction->setUser($createur);

        // Sauvegarde
        $this->entityManager->persist($sanction);
        $this->entityManager->flush();

        return $sanction;
    }

    public function recupererSanctions(): array
    {
        return $this->entityManager->getRepository(Sanctions::class)->findAll();
    }
}