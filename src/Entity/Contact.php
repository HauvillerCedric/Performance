<?php

namespace App\Entity;

use App\Repository\ContactRepository;
use App\Trait\MigrationTrait;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ContactRepository::class)]
class Contact
{
    use MigrationTrait;

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

    #[ORM\Column(length: 30)]
    #[Assert\NotBlank(
        message: "Merci d'inscire votre nom"
    )]
    #[Assert\Length(
        min: 2,
        max: 30,
        minMessage: 'Votre nom doit faire plus de {{ limit }} caractères',
        maxMessage: 'Votre nom ne doit pas faire plus de {{ limit }} caracxtères',
    )]
    private ?string $lastName = null;

    #[ORM\Column(length: 20)]
    #[Assert\NotBlank(
        message: "Merci d'inscire le numéro de téléphone"
    )]
    #[Assert\Length(
        min: 5,
        max: 20,
        minMessage: 'Votre numéro doit faire plus de {{ limit }} caractères',
        maxMessage: 'Votre numéro ne doit pas faire plus de {{ limit }} caracxtères',
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

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(
        message: "Merci d'inscire le sujet du mail"
    )]
    private ?string $description = null;

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

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }
}
