<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'sanctions')]
class Sanction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\ManyToOne(targetEntity: Etudiant::class)]
    #[ORM\JoinColumn(name: 'etudiant_id', referencedColumnName: 'id', nullable: false)]
    private Etudiant $etudiant;

    #[ORM\Column(type: 'string', length: 255)]
    private string $nomProfesseur;

    #[ORM\Column(type: 'string', length: 255)]
    private string $motif;

    #[ORM\Column(type: 'text')]
    private string $description;

    #[ORM\Column(type: 'datetime')]
    private \DateTime $dateIncident;

    #[ORM\Column(type: 'datetime')]
    private \DateTime $dateCreation;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'createur_id', referencedColumnName: 'id', nullable: false)]
    private User $createur;

    // Getters / Setters

    public function getId(): int
    {
        return $this->id;
    }

    public function getEtudiant(): Etudiant
    {
        return $this->etudiant;
    }
    public function setEtudiant(Etudiant $etudiant): self
    {
        $this->etudiant = $etudiant;
        return $this;
    }

    public function getNomProfesseur(): string
    {
        return $this->nomProfesseur;
    }
    public function setNomProfesseur(string $nomProfesseur): self
    {
        $this->nomProfesseur = $nomProfesseur;
        return $this;
    }

    public function getMotif(): string
    {
        return $this->motif;
    }
    public function setMotif(string $motif): self
    {
        $this->motif = $motif;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getDateIncident(): \DateTime
    {
        return $this->dateIncident;
    }
    public function setDateIncident(\DateTime $date): self
    {
        $this->dateIncident = $date;
        return $this;
    }

    public function getDateCreation(): \DateTime
    {
        return $this->dateCreation;
    }
    public function setDateCreation(\DateTime $date): self
    {
        $this->dateCreation = $date;
        return $this;
    }

    public function getCreateur(): User
    {
        return $this->createur;
    }
    public function setCreateur(User $createur): self
    {
        $this->createur = $createur;
        return $this;
    }
}