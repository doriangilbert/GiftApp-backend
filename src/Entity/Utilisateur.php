<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UtilisateurRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

/**
 * @ORM\Entity(repositoryClass=UtilisateurRepository::class)
 */
#[ApiResource()]
class Utilisateur implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\OneToMany(targetEntity=Cadeau::class, mappedBy="demandeur")
     */
    private $demande;

    /**
     * @ORM\OneToMany(targetEntity=Liste::class, mappedBy="concerne")
     */
    private $concerne;

    /**
     * @ORM\OneToMany(targetEntity=Groupe::class, mappedBy="possede")
     */
    private $possede;

    /**
     * @ORM\ManyToMany(targetEntity=Groupe::class, mappedBy="appartient")
     */
    private $appartient;


    public function __construct()
    {
        $this->demande = new ArrayCollection();
        $this->concerne = new ArrayCollection();
        $this->possede = new ArrayCollection();
        $this->appartient = new ArrayCollection();
        
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * @return Collection|Cadeau[]
     */
    public function getDemande(): Collection
    {
        return $this->demande;
    }

    public function addDemande(Cadeau $demande): self
    {
        if (!$this->demande->contains($demande)) {
            $this->demande[] = $demande;
            $demande->setDemandeur($this);
        }

        return $this;
    }

    public function removeDemande(Cadeau $demande): self
    {
        if ($this->demande->removeElement($demande)) {
            // set the owning side to null (unless already changed)
            if ($demande->getDemandeur() === $this) {
                $demande->setDemandeur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Liste[]
     */
    public function getConcerne(): Collection
    {
        return $this->concerne;
    }

    public function addConcerne(Liste $concerne): self
    {
        if (!$this->concerne->contains($concerne)) {
            $this->concerne[] = $concerne;
            $concerne->setConcerne($this);
        }

        return $this;
    }

    public function removeConcerne(Liste $concerne): self
    {
        if ($this->concerne->removeElement($concerne)) {
            // set the owning side to null (unless already changed)
            if ($concerne->getConcerne() === $this) {
                $concerne->setConcerne(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Groupe[]
     */
    public function getPossede(): Collection
    {
        return $this->possede;
    }

    public function addPossede(Groupe $possede): self
    {
        if (!$this->possede->contains($possede)) {
            $this->possede[] = $possede;
            $possede->setPossede($this);
        }

        return $this;
    }

    public function removePossede(Groupe $possede): self
    {
        if ($this->possede->removeElement($possede)) {
            // set the owning side to null (unless already changed)
            if ($possede->getPossede() === $this) {
                $possede->setPossede(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Groupe[]
     */
    public function getAppartient(): Collection
    {
        return $this->appartient;
    }

    public function addAppartient(Groupe $appartient): self
    {
        if (!$this->appartient->contains($appartient)) {
            $this->appartient[] = $appartient;
            $appartient->addAppartient($this);
        }

        return $this;
    }

    public function removeAppartient(Groupe $appartient): self
    {
        if ($this->appartient->removeElement($appartient)) {
            $appartient->removeAppartient($this);
        }

        return $this;
    }
}
