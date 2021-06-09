<?php

namespace App\Entity;

use App\Entity\Cadeau;
use App\Entity\Utilisateur;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ListeRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=ListeRepository::class)
 */
#[ApiResource()]
class Liste
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $libelle;

    /**
     * @ORM\ManyToMany(targetEntity=Cadeau::class, inversedBy="estCompris")
     */
    private $comprend;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateur::class, inversedBy="concerne")
     */
    private $concerne;

    /**
     * @ORM\ManyToMany(targetEntity=groupe::class, inversedBy="partage")
     */
    private $partage;

    public function __construct()
    {
        $this->comprend = new ArrayCollection();
        $this->partage = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(?string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection|Cadeau[]
     */
    public function getComprend(): Collection
    {
        return $this->comprend;
    }

    public function addComprend(Cadeau $comprend): self
    {
        if (!$this->comprend->contains($comprend)) {
            $this->comprend[] = $comprend;
        }

        return $this;
    }

    public function removeComprend(Cadeau $comprend): self
    {
        $this->comprend->removeElement($comprend);

        return $this;
    }

    public function getConcerne(): ?Utilisateur
    {
        return $this->concerne;
    }

    public function setConcerne(?Utilisateur $concerne): self
    {
        $this->concerne = $concerne;

        return $this;
    }

    /**
     * @return Collection|groupe[]
     */
    public function getPartage(): Collection
    {
        return $this->partage;
    }

    public function addPartage(groupe $partage): self
    {
        if (!$this->partage->contains($partage)) {
            $this->partage[] = $partage;
        }

        return $this;
    }

    public function removePartage(groupe $partage): self
    {
        $this->partage->removeElement($partage);

        return $this;
    }
}
