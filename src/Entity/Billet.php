<?php

namespace App\Entity;

use App\Repository\BilletRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BilletRepository::class)]
class Billet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $NumerodeBillet = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $DateSeance = null;

    #[ORM\Column(length: 255)]
    private ?string $Groupe = null;

    #[ORM\Column]
    private ?float $Prix = null;

    #[ORM\ManyToOne(inversedBy: 'Billets')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Utilisateur $utilisateur = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumerodeBillet(): ?int
    {
        return $this->NumerodeBillet;
    }

    public function setNumerodeBillet(int $NumerodeBillet): static
    {
        $this->NumerodeBillet = $NumerodeBillet;

        return $this;
    }

    public function getDateSeance(): ?\DateTimeInterface
    {
        return $this->DateSeance;
    }

    public function setDateSeance(\DateTimeInterface $DateSeance): static
    {
        $this->DateSeance = $DateSeance;

        return $this;
    }

    public function getGroupe(): ?string
    {
        return $this->Groupe;
    }

    public function setGroupe(string $Groupe): static
    {
        $this->Groupe = $Groupe;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->Prix;
    }

    public function setPrix(float $Prix): static
    {
        $this->Prix = $Prix;

        return $this;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?Utilisateur $utilisateur): static
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }
}
