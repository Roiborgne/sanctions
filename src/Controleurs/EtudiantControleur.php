<?php

namespace App\Controleurs;

use App\UsersStory\Etudiant;
use App\UsersStory\CreateAccount;
use App\UsersStory\Promotion;
use Doctrine\ORM\EntityManager;


class EtudiantControleur extends AbstractController {
    private EntityManager $entityManager;

    /**
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager){
        $this->entityManager = $entityManager;
    }
    public function index(): void
    {
        // Récupérer toutes les promotions
        $promotions = $this->entityManager
            ->getRepository(Promotion::class)
            ->findAll();
        var_dump($promotions);
        $this->render('etudiant/importer', [
            'promotions' => $promotions,
            'entityManager' => $this->entityManager
        ]);
    }
    public function Importer()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                // Récupérer les données du formulaire
                $fichier = $_FILES['fichier']['tmp_name']; // Correction pour gérer le fichier uploadé
                if (!$fichier) {
                    throw new \InvalidArgumentException("Veuillez sélectionner un fichier");
                }

                $prom = $_POST['prom'];
                if (!$prom) {
                    throw new \InvalidArgumentException("Veuillez sélectionner une promotion");
                }

                // Vérifier le type de fichier
                if ($_FILES['fichier']['type'] !== 'text/csv') {
                    throw new \InvalidArgumentException("Le fichier doit être au format CSV");
                }

                // Tenter de créer l'étudiant
                $newEtudiant = new Etudiant($this->entityManager);
                $newEtudiant->importerEtudiant($fichier, $prom);

                // Si l'importation réussit
                $_SESSION["message"]['success'] = "Les étudiants ont été importés avec succès !";
                $this->redirect('/');
                exit;

            } catch (\InvalidArgumentException $e) {
                $_SESSION["message"]['warning'] = "Les étudiants n'ont pas été importés !";
                $_SESSION['error'] = $e->getMessage();

                // Stocker les données du formulaire pour les réafficher
                $_SESSION['form_data'] = [
                    'prom' => $prom ?? null
                ];

                $this->render('etudiant/importer');
                exit;
            }
        }

        $this->render('etudiant/importer');
    }
}


