<?php

namespace App\UsersStory;

use App\Entity\Promotions;
use Doctrine\ORM\EntityManager;

class Promotion{
    private EntityManager $entityManager;
    public function __construct(EntityManager $entityManager){
        $this->entityManager = $entityManager;
    }
    public function ajouterProm($libelle, $annee) :Promotions {

        // Vérifier que les données sont présentes
        if (empty($libelle) || empty($annee)) {
            throw new \InvalidArgumentException("Tous les champs doivent être renseignés.");
        }elseif (!ctype_digit($annee)){
            throw new \InvalidArgumentException("L'année doit être composé de nombre uniquement");
        }
        // Vérifier que la promotion n'existe pas déjà
        $existingLib = $this->entityManager->getRepository(Promotions::class)->findOneBy(['libelle' => $libelle]);
        $existingAn = $this->entityManager->getRepository(Promotions::class)->findOneBy(['annee' => $annee]);
        if ($existingLib != NULL && $existingAn != NULL ) {
            throw new \InvalidArgumentException("La promotion existe déjà !");
        }
        // 2. Créer une instance de la classe Promotion
        $prom = new Promotions();
        $prom->setLibelle($libelle);
        $prom->setAnnee($annee);

        // 3. Persister la promotion
        $this->entityManager->persist($prom);
        $this->entityManager->flush();

        return $prom;
    }
    public function recupererProm() :array {
        $promotions = $this->entityManager->getRepository(Promotions::class)->findAll();
        return $promotions;
    }
}