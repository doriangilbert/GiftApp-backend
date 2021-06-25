<?php

namespace App\Entity;

use App\Repository\GroupRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GroupRepository::class)
 * @ORM\Table(name="`group`")
 */
class Group
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="own")
     */
    private $owneredBy;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, mappedBy="belongsTo")
     */
    private $has;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, mappedBy="invitedTo")
     */
    private $invite;

    public function __construct()
    {
        $this->has = new ArrayCollection();
        $this->invite = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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

    public function getOwneredBy(): ?User
    {
        return $this->owneredBy;
    }

    public function setOwneredBy(?User $owneredBy): self
    {
        $this->owneredBy = $owneredBy;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getHas(): Collection
    {
        return $this->has;
    }

    public function addHa(User $ha): self
    {
        if (!$this->has->contains($ha)) {
            $this->has[] = $ha;
            $ha->addBelongsTo($this);
        }

        return $this;
    }

    public function removeHa(User $ha): self
    {
        if ($this->has->removeElement($ha)) {
            $ha->removeBelongsTo($this);
        }

        return $this;
    }
}
