<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\GroupeRepository;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=GroupeRepository::class)
 */
#[ApiResource()]
class Groupe
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
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity=Liste::class, mappedBy="partage")
     */
    private $partage;

    /**
     * @ORM\ManyToOne(targetEntity=utilisateur::class, inversedBy="possede")
     */
    private $possede;

    /**
     * @ORM\ManyToMany(targetEntity=utilisateur::class, inversedBy="appartient")
     */
    private $appartient;

   

    public function __construct()
    {
        $this->partage = new ArrayCollection();
        $this->appartient = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection|Liste[]
     */
    public function getPartage(): Collection
    {
        return $this->partage;
    }

    public function addPartage(Liste $partage): self
    {
        if (!$this->partage->contains($partage)) {
            $this->partage[] = $partage;
            $partage->addPartage($this);
        }

        return $this;
    }

    public function removePartage(Liste $partage): self
    {
        if ($this->partage->removeElement($partage)) {
            $partage->removePartage($this);
        }

        return $this;
    }

    public function getPossede(): ?utilisateur
    {
        return $this->possede;
    }

    public function setPossede(?utilisateur $possede): self
    {
        $this->possede = $possede;

        return $this;
    }

    /**
     * @return Collection|utilisateur[]
     */
    public function getAppartient(): Collection
    {
        return $this->appartient;
    }

    public function addAppartient(utilisateur $appartient): self
    {
        if (!$this->appartient->contains($appartient)) {
            $this->appartient[] = $appartient;
        }

        return $this;
    }

    public function removeAppartient(utilisateur $appartient): self
    {
        $this->appartient->removeElement($appartient);

        return $this;
    }


}
