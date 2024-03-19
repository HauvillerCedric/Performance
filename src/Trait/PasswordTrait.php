<?php

namespace App\Trait;

use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Validator\Constraints as Assert;

use App\Entity\User;

// Il faut inclure le Trait dans chaque entité utilisant un mot-de-passe (afin de bénéficier de l'attribut $plainPassword et de la méthode getPlainPassword())
trait PasswordTrait
{

    public function __construct(private UserPasswordHasherInterface $passwordHasher )
    {
    }
    #[Assert\Length(min: 6, max: 4096)]
    #[Assert\NotCompromisedPassword]
    private ?string $plainPassword=null;

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(?string $password): static
    {
        $this->plainPassword = $password;

        return $this;
    }

    /**
     * Fait les traitements sur l'entité User avant création du form builder dans le Crud Controller easyadmin
     * À utiliser dans les méthodes createNewFormBuilder et createEditFormBuilder
     */
    private function checkEntityWithPasswordBeforeFlushTrait(&$entity)
    {
        //Encode le nouveau mot de passe s'il est donné
        if( $entity->getPlainPassword() )
        {
            $entity->setPassword($this->passwordHasher->hashPassword($entity, $entity->getPlainPassword()));
        }
    }
}
