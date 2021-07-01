<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\SerializedName;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ApiResource(
 *  normalizationContext={"groups"={"user:read"}},
 *  denormalizationContext={"groups"={"user:write"}}
 *)
 */

 ///Write : email, firstName, lastName, password
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"user:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Groups({"user:read", "user:write"})
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     * @Groups({"user:read"})
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user:read", "user:write"})
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user:read", "user:write"})
     */
    private $lastName;

    /**
     * @Groups({"user:write"})
     * @SerializedName("password")
     */
    private $plainPassword;

    /**
     * @ORM\OneToMany(targetEntity=Gift::class, mappedBy="wishedBy")
     */
    private $wish;

    /**
     * @ORM\OneToMany(targetEntity=Gift::class, mappedBy="offeredBy")
     */
    private $offer;

    /**
     * @ORM\OneToMany(targetEntity=Group::class, mappedBy="owneredBy")
     */
    private $own;

    /**
     * @ORM\ManyToMany(targetEntity=Group::class, inversedBy="has")
     */
    private $belongsTo;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="friends")
     */
    private $friend;

    public function __construct()
    {
        $this->wish = new ArrayCollection();
        $this->offer = new ArrayCollection();
        $this->own = new ArrayCollection();
        $this->belongsTo = new ArrayCollection();
        $this->invitedTo = new ArrayCollection();
        $this->friend = new ArrayCollection();
        $this->friends = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
        $this->plainPassword = null;
    }

    public function getUsername()
    {
        return $this->email;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(string $plainPassword): self
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

    /**
     * @return Collection|Gift[]
     */
    public function getWish(): Collection
    {
        return $this->wish;
    }

    public function addWish(Gift $wish): self
    {
        if (!$this->wish->contains($wish)) {
            $this->wish[] = $wish;
            $wish->setWishedBy($this);
        }

        return $this;
    }

    public function removeWish(Gift $wish): self
    {
        if ($this->wish->removeElement($wish)) {
            // set the owning side to null (unless already changed)
            if ($wish->getWishedBy() === $this) {
                $wish->setWishedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Gift[]
     */
    public function getOffer(): Collection
    {
        return $this->offer;
    }

    public function addOffer(Gift $offer): self
    {
        if (!$this->offer->contains($offer)) {
            $this->offer[] = $offer;
            $offer->setOfferedBy($this);
        }

        return $this;
    }

    public function removeOffer(Gift $offer): self
    {
        if ($this->offer->removeElement($offer)) {
            // set the owning side to null (unless already changed)
            if ($offer->getOfferedBy() === $this) {
                $offer->setOfferedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Group[]
     */
    public function getOwn(): Collection
    {
        return $this->own;
    }

    public function addOwn(Group $own): self
    {
        if (!$this->own->contains($own)) {
            $this->own[] = $own;
            $own->setOwneredBy($this);
        }

        return $this;
    }

    public function removeOwn(Group $own): self
    {
        if ($this->own->removeElement($own)) {
            // set the owning side to null (unless already changed)
            if ($own->getOwneredBy() === $this) {
                $own->setOwneredBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Group[]
     */
    public function getBelongsTo(): Collection
    {
        return $this->belongsTo;
    }

    public function addBelongsTo(Group $belongsTo): self
    {
        if (!$this->belongsTo->contains($belongsTo)) {
            $this->belongsTo[] = $belongsTo;
        }

        return $this;
    }

    public function removeBelongsTo(Group $belongsTo): self
    {
        $this->belongsTo->removeElement($belongsTo);

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getFriend(): Collection
    {
        return $this->friend;
    }

    public function addFriend(self $friend): self
    {
        if (!$this->friend->contains($friend)) {
            $this->friend[] = $friend;
        }

        return $this;
    }

    public function removeFriend(self $friend): self
    {
        $this->friend->removeElement($friend);

        return $this;
    }
}
