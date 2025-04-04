<?php

namespace App\UsersStory;

use App\Entity\Etudiants;
use Doctrine\ORM\EntityManager;

class Etudiant
{

    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function importerEtudiant($fichier, $prom): array
    {
        if (empty($fichier) || empty($prom)) {
            throw new \InvalidArgumentException("Tous les champs doivent être renseignés.");
        }

        if (is_numeric($prom)) {
            $promotion = $this->entityManager->getRepository(\App\Entity\Promotions::class)->find($prom);
        } else {
            $promotion = $prom;
        }

        if (!$promotion) {
            throw new \InvalidArgumentException("Promotion introuvable.");
        }

        $handle = fopen($fichier, 'r');
        if ($handle === false) {
            throw new \RuntimeException("Impossible d'ouvrir le fichier.");
        }

        $importes = 0;
        $ignores = 0;

        while (($data = fgetcsv($handle, 1000, ',')) !== false) {
            if (count($data) < 2 || empty($data[0]) || empty($data[1])) {
                $ignores++;
                continue;
            }

            [$prenom, $nom] = $data;

            $etudiant = new \App\Entity\Etudiants();
            $etudiant->setPrenom(trim($prenom));
            $etudiant->setNom(trim($nom));
            $etudiant->setProm($promotion);

            $this->entityManager->persist($etudiant);
            $importes++;
        }

        fclose($handle);
        $this->entityManager->flush();

        return ['importés' => $importes, 'ignorés' => $ignores];
    }
}