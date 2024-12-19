<?php

namespace App\Entity;
use App\UsersStory\Etudiant;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'Etudiants')]
class Etudiants //Extends Promotions
{
    #[ORM\Id]
    #[ORM\Column(name: 'id_etudiant', type: 'integer')]
    #[ORM\GeneratedValue]
    private int $id;

    #[ORM\Column(name: 'nom', type: 'string', length: 50)]
    private string $nom;

    #[ORM\Column(name: 'prenom', type: 'string', length: 50)]
    private string $prenom;

    #[ORM\ManyToOne(targetEntity: Promotions::class)]
    #[ORM\JoinColumn(name: 'id_prom', nullable: false)]
    private Promotions $promotion;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    public function getPrenom(): string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): void
    {
        $this->prenom = $prenom;
    }

    public function getProm(): Promotions
    {
        return $this->promotion;
    }

    public function setProm(Promotions $prom): void
    {
        $this->promotion = $prom;
    }
}