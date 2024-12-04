<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'Promotions')]
class Promotions
{
    #[ORM\Id]
    #[ORM\Column(name: 'id_prom', type: 'integer')]
    #[ORM\GeneratedValue]
    private int $id;
    #[ORM\Column(name: 'libelle', type: 'string', length: 50)]
    private string $libelle;
    #[ORM\Column(name: 'annee', type: 'string', length: 50)]
    private string $annee;

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getLibelle(): string
    {
        return $this->libelle;
    }

    public function setAnnee(string $annee): void
    {
        $this->annee = $annee;
    }
    public function getAnnee(): string
    {
        return $this->annee;
    }

    public function setLibelle(string $libelle): void
    {
        $this->libelle = $libelle;
    }
}