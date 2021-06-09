<?php

namespace App\Entity;

use App\Entity\Liste;
use App\Entity\Utilisateur;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CadeauRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=CadeauRepository::class)
 */
#[ApiResource()]
class Cadeau
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libelle;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lienImage;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lienSiteWeb;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateur::class, inversedBy="demande")
     */
    private $demandeur;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateur::class)
     */
    private $acheteur;

    /**
     * @ORM\ManyToMany(targetEntity=Liste::class, mappedBy="comprend")
     */
    private $estCompris;

    public function __construct()
    {
        $this->estCompris = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getLienImage(): ?string
    {
        return $this->lienImage;
    }

    public function setLienImage(?string $lienImage): self
    {
        $this->lienImage = $lienImage;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getLienSiteWeb(): ?string
    {
        return $this->lienSiteWeb;
    }

    public function setLienSiteWeb(?string $lienSiteWeb): self
    {
        $this->lienSiteWeb = $lienSiteWeb;

        return $this;
    }

    public function getDemandeur(): ?Utilisateur
    {
        return $this->demandeur;
    }

    public function setDemandeur(?Utilisateur $demandeur): self
    {
        $this->demandeur = $demandeur;

        return $this;
    }

    public function getAcheteur(): ?Utilisateur
    {
        return $this->acheteur;
    }

    public function setAcheteur(?Utilisateur $acheteur): self
    {
        $this->acheteur = $acheteur;

        return $this;
    }

    /**
     * @return Collection|Liste[]
     */
    public function getEstCompris(): Collection
    {
        return $this->estCompris;
    }

    public function addEstCompri(Liste $estCompri): self
    {
        if (!$this->estCompris->contains($estCompri)) {
            $this->estCompris[] = $estCompri;
            $estCompri->addComprend($this);
        }

        return $this;
    }

    public function removeEstCompri(Liste $estCompri): self
    {
        if ($this->estCompris->removeElement($estCompri)) {
            $estCompri->removeComprend($this);
        }

        return $this;
    }
}
