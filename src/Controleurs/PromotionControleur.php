<?php

namespace App\Controleurs;

use App\UsersStory\Promotion;
use Doctrine\ORM\EntityManager;


class PromotionControleur extends AbstractController {
    private EntityManager $entityManager;

    /**
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager){
        $this->entityManager = $entityManager;
    }
    public function Ajouter()
    {
        if (isset($_SESSION['user'])) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                try {
                    // Récupérer les données du formulaire
                    $libelle = trim($_POST['libelle']);
                    $annee = trim($_POST['annee']);

                    // Tenter de créer la promotion
                    $newProm = new Promotion($this->entityManager);
                    $newProm->ajouterProm($libelle, $annee);


                    // Si la création réussit
                    $_SESSION["message"]['success'] = "La promotion créé avec succès !";
                    // Redirection vers l'accueil
                    $this->redirect('/');
                    exit;

                } catch (\InvalidArgumentException $e) {
                    $_SESSION["message"]['warning'] = "La promotion n'a pas été créé !";
                    // Stocker le message d'erreur dans la session
                    $_SESSION['error'] = $e->getMessage();

                    // Stocker les données du formulaire pour les réafficher
                    $_SESSION['form_data'] = [
                        'libelle' => $libelle,
                        'annee' => $annee,
                    ];
                    // Rediriger vers le formulaire
                    $this->render('promotion/ajouter');
                    exit;
                }
            }
            $this->render('/promotion/ajouter');
        }
        $this->render('/compte/connexion');
    }
}