<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\GiftRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=GiftRepository::class)
 * @ApiResource()
 */
class Gift
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imageUrl;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $url;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="wish")
     */
    private $wishedBy;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="offer")
     */
    private $offeredBy;

    /**
     * @ORM\ManyToOne(targetEntity=ListOfGift::class, inversedBy="include")
     */
    private $includedBy;


    public function __construct()
    {
        $this->isIncluded = new ArrayCollection();
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

    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    public function setImageUrl(?string $imageUrl): self
    {
        $this->imageUrl = $imageUrl;

        return $this;
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

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(?string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getWishedBy(): ?User
    {
        return $this->wishedBy;
    }

    public function setWishedBy(?User $wishedBy): self
    {
        $this->wishedBy = $wishedBy;

        return $this;
    }

    public function getOfferedBy(): ?User
    {
        return $this->offeredBy;
    }

    public function setOfferedBy(?User $offeredBy): self
    {
        $this->offeredBy = $offeredBy;

        return $this;
    }

    public function getIncludedBy(): ?ListOfGift
    {
        return $this->includedBy;
    }

    public function setIncludedBy(?ListOfGift $includedBy): self
    {
        $this->includedBy = $includedBy;

        return $this;
    }
}
