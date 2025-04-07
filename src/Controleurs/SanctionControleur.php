<?php

namespace App\Controleurs;

use App\UserStory\CreateSanction;
use App\Entity\Promotions;
use Doctrine\ORM\EntityManager;

class SanctionControleur
{
    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function index(): void
    {
        $sanctions = $this->entityManager->getRepository(\App\Entity\Sanction::class)->findAll();
        include __DIR__ . '/../../views/sanction/index.php';
    }

    public function create(): void
    {
        session_start();

        $formData = $_POST ?? ['promotion_id' => '', 'etudiant_id' => '', 'nom_professeur' => '', 'motif' => '', 'description' => '', 'date_incident' => ''];
        $errors = [];

        $promotionRepo = $this->entityManager->getRepository(Promotions::class);
        $etudiantRepo = $this->entityManager->getRepository(\App\Entity\Etudiants::class);

        $promotions = $promotionRepo->findAll();
        $etudiants = [];

        if (!empty($formData['promotion_id'])) {
            $etudiants = $etudiantRepo->findBy(['promotion' => $formData['promotion_id']]);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $createurId = $_SESSION['user']->getId();

                $useCase = new CreateSanction($this->entityManager);
                $useCase->execute(
                    $formData['etudiant_id'],
                    $formData['nom_professeur'],
                    $formData['motif'],
                    $formData['description'],
                    $formData['date_incident'],
                    $createurId
                );

                header("Location: /sanction");
                exit;
            } catch (\Exception $e) {
                $errors['general'] = $e->getMessage();
            }
        }

        include __DIR__ . '/../../views/sanction/create.php';
    }
}
