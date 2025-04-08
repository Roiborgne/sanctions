<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'sanctions')]
class Sanctions
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name:'id',type: 'integer')]
    private int $id;

    #[ORM\ManyToOne(targetEntity: Etudiants::class)]
    #[ORM\JoinColumn(name: 'id_etudiant', nullable: false)]
    #[ORM\Column(name: 'id_etudiant', type: 'integer')]
    private Etudiants $etudiant;

    #[ORM\Column(name: 'nom_prof',type: 'string', length: 255)]
    private string $nomProfesseur;

    #[ORM\Column(name: 'motif',type: 'string', length: 255)]
    private string $motif;

    #[ORM\Column(name: 'description',type: 'text')]
    private string $description;

    #[ORM\Column(name: 'date_incident',type: 'datetime')]
    private \DateTime $dateIncident;

    #[ORM\Column(name: 'date_creation',type: 'datetime')]
    private \DateTime $dateCreation;

    #[ORM\ManyToOne(targetEntity: Users::class)]
    #[ORM\JoinColumn(name: 'id_user', nullable: false)]
    #[ORM\Column(name: 'id_user', type: 'integer')]
    private Users $user;

    // Getters / Setters

    public function getId_etudiant(): int
    {
        return $this->id;
    }

    public function getEtudiant(): Etudiants
    {
        return $this->etudiant;
    }
    public function setEtudiant(Etudiants $etudiant): self
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

    public function getUser(): Users
    {
        return $this->user;
    }
    public function setUser(Users $user): self
    {
        $this->user = $user;
        return $this;
    }
}