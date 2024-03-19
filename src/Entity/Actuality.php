<?php

namespace App\Entity;

use App\Repository\ActualityRepository;
use App\Trait\MigrationTrait;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


#[ORM\Entity(repositoryClass: ActualityRepository::class)]
#[Vich\Uploadable]
class Actuality
{
    use MigrationTrait, TimestampableEntity ;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(
        message: "Merci d'inscire un titre"
    )]
    #[Assert\Length(
        min: 2,
        max: 255,
        minMessage: 'Le titre doit faire plus de {{ limit }} caractères',
        maxMessage: 'Le titre ne doit pas faire plus de {{ limit }} caracxtères',
    )]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(
        message: "Merci d'inscrire une description"
    )]
    private ?string $description = null;

    #[Vich\UploadableField(mapping: 'actualities', fileNameProperty: 'imageName')]
    private ?File $imageFile = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imageName = null;

    #[ORM\Column(length: 255)]
    #[Gedmo\Slug(fields:['title'])]
    private ?string $slug = null;

    #[ORM\ManyToOne(inversedBy: 'actualities')]
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

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
