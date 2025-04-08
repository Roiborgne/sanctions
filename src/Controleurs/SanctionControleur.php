<?php

namespace App\Controleurs;

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
        $sanctions = $this->entityManager->getRepository(\App\Entity\Sanctions::class)->findAll();
        $this->render('sanction/index', [
            'sanctions' => $sanctions,
            'entityManager' => $this->entityManager
        ]);
    }

    public function create(): void
    {

        $formData = $_POST ?? ['promotion_id' => '', 'id_etudiant' => '', 'nom_professeur' => '', 'motif' => '', 'description' => '', 'date_incident' => ''];
        $errors = [];

        $promotionRepo = $this->entityManager->getRepository(Promotions::class);
        $etudiantRepo = $this->entityManager->getRepository(\App\Entity\Etudiants::class);

        $promotions = $promotionRepo->findAll();
        $etudiants = $etudiantRepo->findAll();


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

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
                    print_r($useCase);
                    $this->render('/sanction/index');

                    exit;
                } catch (\Exception $e) {
                    $errors['general'] = $e->getMessage();
                }
            }
        $this->render('/sanction/create',["promotions" =>$promotions,
            'etudiants' => $etudiants,]);
    }
}
