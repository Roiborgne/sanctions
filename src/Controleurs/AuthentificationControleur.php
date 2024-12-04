<?php

namespace App\Controleurs;

use App\usersStory\CreateAccount;
use App\usersStory\Login;
use App\usersStory\Logout;
use Doctrine\ORM\EntityManager;
use App\Entity\Users;

class AuthentificationControleur extends AbstractController
{
private EntityManager $entityManager;

    /**
     * @param EntityManager $entityManager
     */
public function __construct(EntityManager $entityManager){
    $this->entityManager = $entityManager;
}
    ////
    //INSCRIPTION
    ////
    public function creer()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                // Récupérer les données du formulaire
                $nom = $_POST['nom'] ?? '';
                $prenom = $_POST['prenom'] ?? '';
                $email = $_POST['email'] ?? '';
                $password = $_POST['password'] ?? '';
                $confpassword = $_POST['confpassword'] ?? '';

                // Tenter de créer le compte
                $newAccount =  new CreateAccount($this->entityManager);
                try {
                    $newAccount-> execute($nom, $prenom, $email, $password, $confpassword);
                }catch (\Exception $e){
                    $_SESSION['warning'] = "Compte n'a pas été créé !";
                }
                // Si la création réussit
                $_SESSION['success'] = "Compte créé avec succès !";
                // Redirection vers l'accueil
                $this->render('compte/connexion');
                exit;

            } catch (\InvalidArgumentException $e) {
                // Stocker le message d'erreur dans la session
                $_SESSION['error'] = $e->getMessage();

                // Stocker les données du formulaire pour les réafficher
                $_SESSION['form_data'] = [
                    'nom' => $nom,
                    'prenom' => $prenom,
                    'email' => $email
                ];
                // Rediriger vers le formulaire
                $this->render('compte/creer');
                exit;
            }
        }
        $this->render('compte/creer');
    }

    //
    //Connexion
    //
    public function connecter()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $email = $_POST['email'] ?? '';
                $password = $_POST['password'] ?? '';
                $login = new Login($this->entityManager);
                $login->execute($email, $password);

                $_SESSION['success'] = "Connexion réussie !";
                // Stockage des informations de l'utilisateur en session
                //$this->creerSession($user);

                $this->redirect('/');
                exit;

            } catch (\InvalidArgumentException $e) {
                $_SESSION['error'] = $e->getMessage();
                $_SESSION['form_data'] = [
                    'email' => $email
                ];
                $this->render('/compte/connexion');
                exit;
            }
        }
        $this->render('/connexion');
    }
    //
    //Déconnexion
    //
    public function deconnecter()
    {
        // Exécuter la déconnexion
        $logout = new Logout();
        $logout -> execute();

        // Démarrer une nouvelle session pour les messages flash
        session_start();

        // Ajouter un message de succès
        $_SESSION['success'] = "Vous avez été déconnecté avec succès !";

        // Rediriger vers la page de connexion
        $this->redirect('/');
        exit;
    }
}