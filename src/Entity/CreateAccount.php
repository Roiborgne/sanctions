<?php

namespace src\Entity;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity]
#[ORM\Table(name: 'createAccount')]
class CreateAccount
{
    private EntityManager $entityManager;

    /**
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager) #EntityManager ajouter par injection de dépendance
    {
        $this->entityManager = $entityManager;
    }

    public function execute(string $pseudo, string $email, string $password) : User{
        //Verifier si les informations sont présente, si tels n'est pas le cas on va lancer une exception
        //Vérifier si l'email est valide, si tels n'est pas le cas on va lancer une exception
        //Vérifier l'unicité de l'email, si tels n'est pas le cas on va lancer une exception
        //Vérifier si le pseudo et entre 2 et 50 caractère, si tels n'est pas le cas on va lancer une exception
        //Vérifier si la mdp est valide, si tels n'est pas le cas on va lancer une exception (>= 8)

        //Insérer les données dans la base de donnée
        //1. Hache le mdp
        #$mdp_hash = hash($password);
        //2.Créer une instance de la classe users avec l'email, le pseudo et le mdp haché
        //Créer une instance de User
        $user = new User(); //Setter

        //Je persiste l'instance avec EntityManager.
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        return $user;
    }//Envoie d'un mail de confirmation à l'utilisateur

}