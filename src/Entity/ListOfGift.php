<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ListOfGiftRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=ListOfGiftRepository::class)
 * @ApiResource()
 */
class ListOfGift
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
    private $title;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     */
    private $concernedBy;

    /**
     * @ORM\OneToMany(targetEntity=Gift::class, mappedBy="includedBy")
     */
    private $include;

    public function __construct()
    {
        $this->include = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getConcernedBy(): ?User
    {
        return $this->concernedBy;
    }

    public function setConcernedBy(?User $concernedBy): self
    {
        $this->concernedBy = $concernedBy;

        return $this;
    }

    /**
     * @return Collection|Gift[]
     */
    public function getInclude(): Collection
    {
        return $this->include;
    }

    public function addInclude(Gift $include): self
    {
        if (!$this->include->contains($include)) {
            $this->include[] = $include;
            $include->setIncludedBy($this);
        }

        return $this;
    }

    public function removeInclude(Gift $include): self
    {
        if ($this->include->removeElement($include)) {
            // set the owning side to null (unless already changed)
            if ($include->getIncludedBy() === $this) {
                $include->setIncludedBy(null);
            }
        }

        return $this;
    }

}
