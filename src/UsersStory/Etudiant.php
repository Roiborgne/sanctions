<?php

namespace App\UsersStory;

use App\Entity\Etudiants;
use Doctrine\ORM\EntityManager;

class Etudiant  {

private EntityManager $entityManager;
    public function __construct(EntityManager $entityManager){
    $this->entityManager = $entityManager;
}
    public function importerEtudiant($fichier, $prom) :Etudiants {

    // Vérifier que les données sont présentes
    if (empty($fichier) || empty($prom)) {
        throw new \InvalidArgumentException("Tous les champs doivent être renseignés.");
    }elseif (!ctype_digit($prom)){
        throw new \InvalidArgumentException("L'année doit être composé de nombre uniquement");
    }
        $this->entityManager->flush();

        // 3. Persister la promotion
    $this->entityManager->persist($prom);
    $this->entityManager->flush();

    return $prom;
    }
}