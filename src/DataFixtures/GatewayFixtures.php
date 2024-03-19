<?php

namespace App\DataFixtures;

use App\Entity\Gateway;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class GatewayFixtures extends Fixture implements DependentFixtureInterface
{
    private $datas;

    public function __construct()
    {
        $this->datas = include (__DIR__.'/../../migrationFixtures/gateway.php');
    }

    public function load(ObjectManager $em): void
    {
        $rpUser = $em->getRepository(User::class);

        foreach ($this->datas as $d)
        {
            $entity = (new Gateway())
                ->setId($d['id'])
                ->setUser($rpUser->find($d['user_id']))
                ->setInscriptionFee($d['inscription_fee'])
                ->setDriving($d['driving'])
                ->setCreatedAt($d['created_at'] == '0000-00-00 00:00:00' ? new \DateTime() : new \DateTime($d['created_at']))
                ->setUpdatedAt(new \DateTime($d['updated_at']))
                ;
            $em->persist($entity);
        }
        $em->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class
        ];
    }
}
