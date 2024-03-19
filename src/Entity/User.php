<?php

namespace App\Entity;

use App\Repository\UserRepository;
use App\Trait\MigrationTrait;
use App\Trait\PasswordTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[Vich\Uploadable]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    use MigrationTrait, TimestampableEntity, PasswordTrait;
    #[ORM\Column(length: 180, unique: true)]
    #[Assert\NotBlank(
        message: "Merci d'inscire votre adresse email"
    )]
    #[Assert\Length(
        min: 2,
        max: 180,
        minMessage: 'Votre adresse email doit faire plus de 2 caractères',
        maxMessage: 'Votre adresse email doit faire moins de 180 caractères',
    )]
    #[Assert\Email(
        message: 'Veuillez entrer une adresse email valide',
    )]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    #[Assert\NotBlank(
        message: "Merci d'entrer un mot de passe"
    )]
    #[Assert\NotCompromisedPassword(
        message: "Mot de passe compromis. Merci de changer de mot de passe"
    )]
    private ?string $password = null;

    #[ORM\Column(length: 20)]
    #[Assert\NotBlank(
        message: "Merci d'inscire votre prénom"
    )]
    #[Assert\Length(
        min: 2,
        max: 20,
        minMessage: 'Votre prénom doit faire plus de 2 caractères',
        maxMessage: 'Votre prénom ne doit pas faire plus de 20 caracxtères',
    )]
    private ?string $firstName = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $lastName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imageName = null;

    #[Vich\UploadableField(mapping: 'users', fileNameProperty: 'imageName')]
    private ?File $imageFile = null;

    #[ORM\Column(length: 40)]
    #[Assert\NotBlank(
        message: "Merci de donner le poste de la personne"
    )]
    #[Assert\Length(
        min: 2,
        max: 40,
        minMessage: 'Le poste doit faire plus de 2 caractères',
        maxMessage: 'Le poste ne doit pas faire plus de 40 caracxtères',
    )]
    #[Assert\Type(
        type: 'string',
        message: 'Le poste ne doit comporter que des lettres',
    )]
    private ?string $fonction = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private ?bool $isActive = true;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Licence::class)]
    private Collection $licences;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Actuality::class)]
    private Collection $actualities;

    #[ORM\OneToOne(mappedBy: 'user', cascade: ['persist', 'remove'])]
    private ?Perfectionnement $perfectionnement = null;

    #[ORM\OneToOne(mappedBy: 'user', cascade: ['persist', 'remove'])]
    private ?Gateway $gateway = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Agency::class)]
    private Collection $agencies;

    public function __construct()
    {
        $this->licences = new ArrayCollection();
        $this->actualities = new ArrayCollection();
        $this->agencies = new ArrayCollection();
        $this->password = uniqid();
        $this->roles[] = 'ROLE_ADMIN';
    }


   public function __toString(): string
    {
        return $this->getFirstName() . $this->getLastName();
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

    public function setRoles(array $roles): static
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

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getFonction(): ?string
    {
        return $this->fonction;
    }

    public function setFonction(string $fonction): static
    {
        $this->fonction = $fonction;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function isIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): static
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * @return Collection<int, Licence>
     */
    public function getLicences(): Collection
    {
        return $this->licences;
    }

    public function addLicence(Licence $licence): static
    {
        if (!$this->licences->contains($licence)) {
            $this->licences->add($licence);
            $licence->setUser($this);
        }

        return $this;
    }

    public function removeLicence(Licence $licence): static
    {
        if ($this->licences->removeElement($licence)) {
            // set the owning side to null (unless already changed)
            if ($licence->getUser() === $this) {
                $licence->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Actuality>
     */
    public function getActualities(): Collection
    {
        return $this->actualities;
    }

    public function addActuality(Actuality $actuality): static
    {
        if (!$this->actualities->contains($actuality)) {
            $this->actualities->add($actuality);
            $actuality->setUser($this);
        }

        return $this;
    }

    public function removeActuality(Actuality $actuality): static
    {
        if ($this->actualities->removeElement($actuality)) {
            // set the owning side to null (unless already changed)
            if ($actuality->getUser() === $this) {
                $actuality->setUser(null);
            }
        }

        return $this;
    }

    public function getPerfectionnement(): ?Perfectionnement
    {
        return $this->perfectionnement;
    }

    public function setPerfectionnement(Perfectionnement $perfectionnement): static
    {
        // set the owning side of the relation if necessary
        if ($perfectionnement->getUser() !== $this) {
            $perfectionnement->setUser($this);
        }

        $this->perfectionnement = $perfectionnement;

        return $this;
    }

    public function getGateway(): ?Gateway
    {
        return $this->gateway;
    }

    public function setGateway(Gateway $gateway): static
    {
        // set the owning side of the relation if necessary
        if ($gateway->getUser() !== $this) {
            $gateway->setUser($this);
        }

        $this->gateway = $gateway;

        return $this;
    }

    /**
     * @return Collection<int, Agency>
     */
    public function getAgencies(): Collection
    {
        return $this->agencies;
    }

    public function addAgency(Agency $agency): static
    {
        if (!$this->agencies->contains($agency)) {
            $this->agencies->add($agency);
            $agency->setUser($this);
        }

        return $this;
    }

    public function removeAgency(Agency $agency): static
    {
        if ($this->agencies->removeElement($agency)) {
            // set the owning side to null (unless already changed)
            if ($agency->getUser() === $this) {
                $agency->setUser(null);
            }
        }

        return $this;
    }
}
