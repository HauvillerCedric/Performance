<?php

namespace App\Entity;

use App\Repository\GatewayRepository;
use App\Trait\MigrationTrait;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: GatewayRepository::class)]
class Gateway
{
    use MigrationTrait, TimestampableEntity;

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

    #[ORM\OneToOne(inversedBy: 'gateway', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    public function getInscriptionFee(): ?float
    {
        return $this->inscriptionFee;
    }

    public function setInscriptionFee(float $inscriptionFee): static
    {
        $this->inscriptionFee = $inscriptionFee;

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): static
    {
        $this->user = $user;

        return $this;
    }
}
