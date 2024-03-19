<?php

namespace App\Entity;

use App\Repository\AgencyRepository;
use App\Trait\MigrationTrait;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: AgencyRepository::class)]
#[Vich\Uploadable]
class Agency
{
    use MigrationTrait, TimestampableEntity ;

    #[ORM\Column(length: 15)]
    #[Assert\NotBlank(
        message: "Merci d'inscire une ville"
    )]
    #[Assert\Length(
        min: 2,
        max: 15,
        minMessage: 'La ville doit faire plus de {{ limit }} caractères',
        maxMessage: 'Le ville ne doit pas faire plus de {{ limit }} caracxtères',
    )]
    private ?string $city = null;

    #[ORM\Column(length: 80)]
    #[Assert\NotBlank(
        message: "Merci d'inscire une rue"
    )]
    #[Assert\Length(
        min: 2,
        max: 80,
        minMessage: 'La rue doit faire plus de {{ limit }} caractères',
        maxMessage: 'Le vrue ne doit pas faire plus de {{ limit }} caracxtères',
    )]
    private ?string $street = null;

    #[ORM\Column(length: 5)]
    #[Assert\NotBlank(
        message: "Merci d'inscire un code postal"
    )]
    #[Assert\Length(
        min: 2,
        max: 5,
        minMessage: 'Le code postal doit faire plus de {{ limit }} caractères',
        maxMessage: 'Le code postal ne doit pas faire plus de {{ limit }} caracxtères',
    )]
    private ?string $zip = null;

    #[ORM\Column(length: 20)]
    #[Assert\NotBlank(
        message: "Merci d'inscire un numéro de téléphone"
    )]
    #[Assert\Length(
        min: 2,
        max: 20,
        minMessage: 'Le numéro de téléphone doit faire plus de {{ limit }} caractères',
        maxMessage: 'Le numéro de téléphone ne doit pas faire plus de {{ limit }} caracxtères',
    )]
    private ?string $mobile = null;

    #[ORM\Column(length: 80)]
    #[Assert\NotBlank(
        message: "Merci d'inscire votre adresse mail"
    )]
    #[Assert\Length(
        min: 5,
        max: 80,
        minMessage: 'Votre adresse mail doit faire plus de {{ limit }} caractères',
        maxMessage: 'Votre adresse mail ne doit pas faire plus de {{ limit }} caracxtères',
    )]
    #[Assert\Email(
        message: 'Adresse non valide',
    )]
    private ?string $email = null;

    #[Vich\UploadableField(mapping: 'agencies', fileNameProperty: 'imageName')]
    private ?File $imageFile = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imageName = null;

    #[ORM\ManyToOne(inversedBy: 'agencies')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $mondayOpening = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $mondayClosing = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $tuesdayOpening = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $tuesdayClosing = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $wednesdayOpening = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $wednesdayClosing = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $thursdayOpening = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $thursdayClosing = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $fridayOpening = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $fridayClosing = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $saturdayOpening = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $saturdayClosing = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $sundayOpening = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $sundayClosing = null;

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(string $street): static
    {
        $this->street = $street;

        return $this;
    }

    public function getZip(): ?string
    {
        return $this->zip;
    }

    public function setZip(string $zip): static
    {
        $this->zip = $zip;

        return $this;
    }

    public function getMobile(): ?string
    {
        return $this->mobile;
    }

    public function setMobile(string $mobile): static
    {
        $this->mobile = $mobile;

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getMondayOpening(): ?\DateTimeInterface
    {
        return $this->mondayOpening;
    }

    public function setMondayOpening(\DateTimeInterface $mondayOpening): static
    {
        $this->mondayOpening = $mondayOpening;

        return $this;
    }

    public function getMondayClosing(): ?\DateTimeInterface
    {
        return $this->mondayClosing;
    }

    public function setMondayClosing(\DateTimeInterface $mondayClosing): static
    {
        $this->mondayClosing = $mondayClosing;

        return $this;
    }

    public function getTuesdayOpening(): ?\DateTimeInterface
    {
        return $this->tuesdayOpening;
    }

    public function setTuesdayOpening(\DateTimeInterface $tuesdayOpening): static
    {
        $this->tuesdayOpening = $tuesdayOpening;

        return $this;
    }

    public function getTuesdayClosing(): ?\DateTimeInterface
    {
        return $this->tuesdayClosing;
    }

    public function setTuesdayClosing(?\DateTimeInterface $tuesdayClosing): static
    {
        $this->tuesdayClosing = $tuesdayClosing;

        return $this;
    }

    public function getWednesdayOpening(): ?\DateTimeInterface
    {
        return $this->wednesdayOpening;
    }

    public function setWednesdayOpening(?\DateTimeInterface $wednesdayOpening): static
    {
        $this->wednesdayOpening = $wednesdayOpening;

        return $this;
    }

    public function getWednesdayClosing(): ?\DateTimeInterface
    {
        return $this->wednesdayClosing;
    }

    public function setWednesdayClosing(?\DateTimeInterface $wednesdayClosing): static
    {
        $this->wednesdayClosing = $wednesdayClosing;

        return $this;
    }

    public function getThursdayOpening(): ?\DateTimeInterface
    {
        return $this->thursdayOpening;
    }

    public function setThursdayOpening(?\DateTimeInterface $thursdayOpening): static
    {
        $this->thursdayOpening = $thursdayOpening;

        return $this;
    }

    public function getThursdayClosing(): ?\DateTimeInterface
    {
        return $this->thursdayClosing;
    }

    public function setThursdayClosing(?\DateTimeInterface $thursdayClosing): static
    {
        $this->thursdayClosing = $thursdayClosing;

        return $this;
    }

    public function getFridayOpening(): ?\DateTimeInterface
    {
        return $this->fridayOpening;
    }

    public function setFridayOpening(?\DateTimeInterface $fridayOpening): static
    {
        $this->fridayOpening = $fridayOpening;

        return $this;
    }

    public function getFridayClosing(): ?\DateTimeInterface
    {
        return $this->fridayClosing;
    }

    public function setFridayClosing(?\DateTimeInterface $fridayClosing): static
    {
        $this->fridayClosing = $fridayClosing;

        return $this;
    }

    public function getSaturdayOpening(): ?\DateTimeInterface
    {
        return $this->saturdayOpening;
    }

    public function setSaturdayOpening(?\DateTimeInterface $saturdayOpening): static
    {
        $this->saturdayOpening = $saturdayOpening;

        return $this;
    }

    public function getSaturdayClosing(): ?\DateTimeInterface
    {
        return $this->saturdayClosing;
    }

    public function setSaturdayClosing(?\DateTimeInterface $saturdayClosing): static
    {
        $this->saturdayClosing = $saturdayClosing;

        return $this;
    }

    public function getSundayOpening(): ?\DateTimeInterface
    {
        return $this->sundayOpening;
    }

    public function setSundayOpening(?\DateTimeInterface $sundayOpening): static
    {
        $this->sundayOpening = $sundayOpening;

        return $this;
    }

    public function getSundayClosing(): ?\DateTimeInterface
    {
        return $this->sundayClosing;
    }

    public function setSundayClosing(?\DateTimeInterface $sundayClosing): static
    {
        $this->sundayClosing = $sundayClosing;

        return $this;
    }
}
