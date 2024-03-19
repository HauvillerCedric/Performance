<?php

namespace App\DataFixtures;

use App\Entity\Licence;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class LicenceFixtures extends Fixture implements DependentFixtureInterface
{
    private $datas;

    public function __construct()
    {
        $this->datas = include (__DIR__.'/../../migrationFixtures/licence.php');
    }
    public function load(ObjectManager $em): void
    {
        $rpUser = $em->getRepository(User::class);

        foreach ($this->datas as $d)
        {
            $entity = (new Licence())
                ->setId($d['id'])
                ->setUser($rpUser->find($d['user_id']))
                ->setTitle($d['title'])
                ->setInscriptionFee($d['inscription_fee'])
                ->setBook($d['book'])
                ->setCard($d['card'])
                ->setCodeBook($d['code_book'])
                ->setInspectionsBook($d['inspections_book'])
                ->setCodePackage($d['code_package'])
                ->setDriving($d['driving'])
                ->setCodeTest($d['code_test'])
                ->setDrivingTest($d['driving_test'])
                ->setInspectionWorkshop($d['inspection_workshop'])
                ->setPreliminaryMeeting($d['preliminary_meeting'])
                ->setFirstPedagogicalMeeting($d['first_pedagogical_meeting'])
                ->setSecondPedagogicalMeeting($d['second_pedagogical_meeting'])
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
