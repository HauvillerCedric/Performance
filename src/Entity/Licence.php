<?php

namespace App\Entity;

use App\Repository\LicenceRepository;
use App\Trait\MigrationTrait;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: LicenceRepository::class)]
class Licence
{
    use MigrationTrait, TimestampableEntity;

    #[ORM\Column(length: 80)]
    #[Assert\NotBlank(
        message: "Merci d'inscire un titre"
    )]
    #[Assert\Length(
        min: 2,
        max: 80,
        minMessage: 'Le titre doit faire plus de 2 caractères',
        maxMessage: 'Le titre ne doit pas faire plus de 80 caracxtères',
    )]
    private ?string $title = null;

    #[ORM\Column]
    #[Assert\NotBlank(
        message: "Merci d'inscire les frais d'inscription"
    )]
    #[Assert\Type(
        type: 'float',
        message: "Merci d'inscire un chiffre",
    )]
    #[Assert\PositiveOrZero(
        message: "Merci de donner une valeur positive ou zéro"
    )]
    private ?float $inscriptionFee = null;

    #[ORM\Column]
    #[Assert\NotBlank(
        message: "Merci d'inscire le prix du livret de coduite"
    )]
    #[Assert\Type(
        type: 'float',
        message: "Merci d'inscire un chiffre",
    )]
    #[Assert\PositiveOrZero(
        message: "Merci de donner une valeur positive ou zéro"
    )]
    private ?float $book = null;

    #[ORM\Column(nullable: true)]
    private ?float $card = null;

    #[ORM\Column(nullable: true)]
    private ?float $codeBook = null;

    #[ORM\Column(nullable: true)]
    private ?float $inspectionsBook = null;

    #[ORM\Column(nullable: true)]
    private ?float $codePackage = null;

    #[ORM\Column]
    #[Assert\NotBlank(
        message: "Merci d'inscire le prix d'une heure de conduite"
    )]
    #[Assert\Type(
        type: 'float',
        message: "Merci d'inscire un chiffre",
    )]
    #[Assert\PositiveOrZero(
        message: "Merci de donner une valeur positive ou zéro"
    )]
    private ?float $driving = null;

    #[ORM\Column(nullable: true)]
    private ?float $codeTest = null;

    #[ORM\Column(nullable: true)]
    private ?float $drivingTest = null;

    #[ORM\Column(nullable: true)]
    private ?float $inspectionWorkshop = null;

    #[ORM\Column(nullable: true)]
    private ?float $preliminaryMeeting = null;

    #[ORM\Column(nullable: true)]
    private ?float $firstPedagogicalMeeting = null;

    #[ORM\Column(nullable: true)]
    private ?float $secondPedagogicalMeeting = null;

    #[ORM\ManyToOne(inversedBy: 'licences')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getInscriptionFee(): ?float
    {
        return $this->inscriptionFee;
    }

    public function setInscriptionFee(float $inscriptionFee): static
    {
        $this->inscriptionFee = $inscriptionFee;

        return $this;
    }

    public function getBook(): ?float
    {
        return $this->book;
    }

    public function setBook(float $book): static
    {
        $this->book = $book;

        return $this;
    }

    public function getCard(): ?float
    {
        return $this->card;
    }

    public function setCard(float $card): static
    {
        $this->card = $card;

        return $this;
    }

    public function getCodeBook(): ?float
    {
        return $this->codeBook;
    }

    public function setCodeBook(?float $codeBook): static
    {
        $this->codeBook = $codeBook;

        return $this;
    }

    public function getInspectionsBook(): ?float
    {
        return $this->inspectionsBook;
    }

    public function setInspectionsBook(?float $inspectionsBook): static
    {
        $this->inspectionsBook = $inspectionsBook;

        return $this;
    }

    public function getCodePackage(): ?float
    {
        return $this->codePackage;
    }

    public function setCodePackage(?float $codePackage): static
    {
        $this->codePackage = $codePackage;

        return $this;
    }

    public function getDriving(): ?float
    {
        return $this->driving;
    }

    public function setDriving(float $driving): static
    {
        $this->driving = $driving;

        return $this;
    }

    public function getCodeTest(): ?float
    {
        return $this->codeTest;
    }

    public function setCodeTest(?float $codeTest): static
    {
        $this->codeTest = $codeTest;

        return $this;
    }

    public function getDrivingTest(): ?float
    {
        return $this->drivingTest;
    }

    public function setDrivingTest(?float $drivingTest): static
    {
        $this->drivingTest = $drivingTest;

        return $this;
    }

    public function getInspectionWorkshop(): ?float
    {
        return $this->inspectionWorkshop;
    }

    public function setInspectionWorkshop(?float $inspectionWorkshop): static
    {
        $this->inspectionWorkshop = $inspectionWorkshop;

        return $this;
    }

    public function getPreliminaryMeeting(): ?float
    {
        return $this->preliminaryMeeting;
    }

    public function setPreliminaryMeeting(?float $preliminaryMeeting): static
    {
        $this->preliminaryMeeting = $preliminaryMeeting;

        return $this;
    }

    public function getFirstPedagogicalMeeting(): ?float
    {
        return $this->firstPedagogicalMeeting;
    }

    public function setFirstPedagogicalMeeting(?float $firstPedagogicalMeeting): static
    {
        $this->firstPedagogicalMeeting = $firstPedagogicalMeeting;

        return $this;
    }

    public function getSecondPedagogicalMeeting(): ?float
    {
        return $this->secondPedagogicalMeeting;
    }

    public function setSecondPedagogicalMeeting(?float $secondPedagogicalMeeting): static
    {
        $this->secondPedagogicalMeeting = $secondPedagogicalMeeting;

        return $this;
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
}
