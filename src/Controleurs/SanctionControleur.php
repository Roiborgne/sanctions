<?php

namespace App\Controleurs;

use App\Entity\Etudiants;
use App\Entity\Sanctions;
use App\Entity\Promotions;
use App\UsersStory\CreateSanction;
use Doctrine\ORM\EntityManager;

class SanctionControleur extends AbstractController {
    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function index(): void
    {
        $sanctions = $this->entityManager->getRepository(Sanctions::class)->findAll();
        $this->render('sanction/index', [
            'sanctions' => $sanctions,
            'entityManager' => $this->entityManager
        ]);
    }

    public function create(): void
    {
        $formData = $_POST + [ // `+` au lieu de `??` pour éviter d’écraser les champs avec des chaînes vides
                'id_prom' => '',
                'id_etudiant' => '',
                'nom_professeur' => '',
                'motif' => '',
                'description' => '',
                'date_incident' => ''
            ];
        $errors = [];

        $promotionRepo = $this->entityManager->getRepository(Promotions::class);
        $etudiantRepo = $this->entityManager->getRepository(Etudiants::class);

        $promotions = $promotionRepo->findAll();

        // Charger les étudiants SEULEMENT si une promotion a été sélectionnée
        $etudiants = [];
        if (!empty($formData['id_prom'])) {
            $etudiants = $etudiantRepo->findBy(['promotion' => $formData['id_prom']]);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($formData['id_etudiant'])) {
            try {
                $createurId = $_SESSION['user']['id'];

                $useCase = new CreateSanction($this->entityManager);
                $useCase->ajouterSanction(
                    $formData['id_etudiant'],
                    $formData['nom_professeur'],
                    $formData['motif'],
                    $formData['description'],
                    $formData['date_incident'],
                    $createurId
                );

                // Rediriger vers l'index après succès
                header("Location: /sanction");
                exit;
            } catch (\Exception $e) {
                $errors['general'] = $e->getMessage();
            }
        }

        $this->render('/sanction/create', [
            "promotions" => $promotions,
            'etudiants' => $etudiants,
            'formData' => $formData,
            'errors' => $errors
        ]);
    }
}
