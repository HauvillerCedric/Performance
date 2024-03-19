<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    private $datas;

    public function __construct()
    {
        $this->datas = include(__DIR__.'/../../migrationFixtures/user.php');
    }

    public function load(ObjectManager $em): void
    {
        foreach ($this->datas as $d) {
            // Décoder la chaîne JSON en un tableau PHP
            $rolesArray = json_decode($d['roles'], true);

            $entity = (new User())
                ->setId($d['id'])
                ->setEmail($d['email'])
                ->setRoles($rolesArray)
                ->setPassword($d['password'])
                ->setFirstName($d['first_name'])
                ->setLastName($d['last_name'])
                ->setFonction($d['fonction'])
                ->setDescription($d['description'])
                ->setIsActive($d['is_active'])
                ->setCreatedAt($d['created_at'] == '0000-00-00 00:00:00' ? new \DateTime() : new \DateTime($d['created_at']))
                ->setUpdatedAt(new \DateTime($d['updated_at']))
            ;

            $em->persist($entity);
        }

        $em->flush();
    }
}
