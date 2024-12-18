<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
class Utilisateur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Nom = null;

    #[ORM\Column(length: 255)]
    private ?string $Prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $Telephone = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $DatedeNaissance = null;

    #[ORM\Column]
    private ?bool $possedeLePermis = null;

    #[ORM\Column]
    private ?int $TypeDeCompte = null;

    /**
     * @var Collection<int, Billet>
     */
    #[ORM\OneToMany(targetEntity: Billet::class, mappedBy: 'utilisateur')]
    private Collection $Billets;

    public function __construct()
    {
        $this->Billets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): static
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(string $Prenom): static
    {
        $this->Prenom = $Prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->Telephone;
    }

    public function setTelephone(string $Telephone): static
    {
        $this->Telephone = $Telephone;

        return $this;
    }

    public function getDatedeNaissance(): ?\DateTimeInterface
    {
        return $this->DatedeNaissance;
    }

    public function setDatedeNaissance(\DateTimeInterface $DatedeNaissance): static
    {
        $this->DatedeNaissance = $DatedeNaissance;

        return $this;
    }

    public function isPossedeLePermis(): ?bool
    {
        return $this->possedeLePermis;
    }

    public function setPossedeLePermis(bool $possedeLePermis): static
    {
        $this->possedeLePermis = $possedeLePermis;

        return $this;
    }

    public function getTypeDeCompte(): ?int
    {
        return $this->TypeDeCompte;
    }

    public function setTypeDeCompte(int $TypeDeCompte): static
    {
        $this->TypeDeCompte = $TypeDeCompte;

        return $this;
    }

    /**
     * @return Collection<int, Billet>
     */
    public function getBillets(): Collection
    {
        return $this->Billets;
    }

    public function addBillet(Billet $billet): static
    {
        if (!$this->Billets->contains($billet)) {
            $this->Billets->add($billet);
            $billet->setUtilisateur($this);
        }

        return $this;
    }

    public function removeBillet(Billet $billet): static
    {
        if ($this->Billets->removeElement($billet)) {
            // set the owning side to null (unless already changed)
            if ($billet->getUtilisateur() === $this) {
                $billet->setUtilisateur(null);
            }
        }

        return $this;
    }
}
