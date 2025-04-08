<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'Etudiants')]
class Etudiants //Extends Promotions
{
    #[ORM\Id]
    #[ORM\Column(name: 'id_etudiant', type: 'integer')]
    #[ORM\GeneratedValue]
    private int $id_etudiant;

    #[ORM\Column(name: 'nom', type: 'string', length: 50)]
    private string $nom;

    #[ORM\Column(name: 'prenom', type: 'string', length: 50)]
    private string $prenom;

    #[ORM\ManyToOne(targetEntity: Promotions::class)]
    #[ORM\JoinColumn(name: 'id_prom', referencedColumnName: "id_prom", nullable: false)]
    private Promotions $promotion;

    public function getId(): int
    {
        return $this->id_etudiant;
    }

    public function setId(int $id_etudiant): void
    {
        $this->id_etudiant = $id_etudiant;
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