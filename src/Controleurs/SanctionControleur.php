<?php

namespace App\Controleurs;

use App\Entity\Etudiants;
use App\Entity\Sanctions;
use App\Entity\Promotions;
use App\UsersStory\CreateSanction;
use Doctrine\ORM\EntityManager;

class SanctionControleur extends AbstractController
{
    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function index(): void
    {
        if (isset($_SESSION['user'])) {
            $sanctions = $this->entityManager->getRepository(Sanctions::class)->findAll();
            $this->render('sanction/index', [
                'sanctions' => $sanctions,
                'entityManager' => $this->entityManager
            ]);
        }
        $this->render('/compte/connexion');
    }

    public function create(): void
    {
        if (isset($_SESSION['user'])) {
            // Formulaire avec valeurs par défaut
            $formData = $_POST + [
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

            // Récupération de toutes les promotions
            $promotions = $promotionRepo->findAll();

            // Chargement des étudiants seulement si une promotion a été sélectionnée
            $etudiants = [];
            if (!empty($formData['id_prom'])) {

                // Vérification de la promotion
                $promotion = $this->entityManager->getRepository(Promotions::class)->find($formData['id_prom']);
                if (!$promotion) {
                    $errors['general'] = "La promotion sélectionnée n'existe pas.";
                } else {
                    // Vérifier s'il y a des étudiants associés à cette promotion
                    $etudiantstest = $this->entityManager->getRepository(Etudiants::class)->findBy(['promotion' => $formData['id_prom']]);
                    if (empty($etudiantstest)) {
                        $errors['general'] = "Il n'y a aucun étudiant dans cette promotion.";
                    } else {
                        // Si des étudiants existent, on les charge pour le formulaire
                        $etudiants = $etudiantRepo->findBy(['promotion' => $formData['id_prom']]);
                    }
                }
            }

            // Vérifier les champs lors de la soumission du formulaire
            if ($_SERVER['REQUEST_METHOD'] === 'POST' and !empty($formData['id_etudiant'])) {
                // Validation des champs
                if (empty($formData['nom_professeur']) || empty($formData['motif']) || empty($formData['description']) || empty($formData['date_incident'])) {
                    $errors['form'] = "Tous les champs doivent être remplis.";
                }

                if (!empty($formData['nom_professeur']) && !empty($formData['motif']) && !empty($formData['description']) && !empty($formData['date_incident'])) {
                    try {
                        $createurId = $_SESSION['user']['id'];

                        // Appeler la méthode pour ajouter la sanction
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
            }

            // Rendu de la vue avec les données et erreurs
            $this->render('/sanction/create', [
                "promotions" => $promotions,
                'etudiants' => $etudiants,
                'formData' => $formData,
                'errors' => $errors
            ]);
        }
        $this->render('/compte/connexion');
    }

}
