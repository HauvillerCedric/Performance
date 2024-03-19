<?php

namespace App\DataFixtures;

use App\Entity\Agency;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class AgencyFixtures extends Fixture implements DependentFixtureInterface
{
    private $datas;

    public function __construct()
    {
        $this->datas = include (__DIR__.'/../../migrationFixtures/agency.php');
    }
    public function load(ObjectManager $em): void
    {
        $rpUser = $em->getRepository(User::class);

        foreach ($this->datas as $d)
        {
            $entity = (new Agency())
                ->setId($d['id'])
                ->setUser($rpUser->find($d['user_id']))
                ->setCity($d['city'])
                ->setStreet($d['street'])
                ->setZip($d['zip'])
                ->setMobile($d['mobile'])
                ->setEmail($d['email'])
                ->setCreatedAt($d['created_at'] == '0000-00-00 00:00:00' ? new \DateTime() : new \DateTime($d['created_at']))
                ->setUpdatedAt(new \DateTime($d['updated_at']))
                ->setMondayOpening(new \DateTime($d['monday_opening']))
                ->setMondayClosing(new \DateTime($d['monday_closing']))
                ->setTuesdayOpening(new \DateTime($d['tuesday_opening']))
                ->setTuesdayClosing(new \DateTime($d['tuesday_closing']))
                ->setWednesdayOpening(new \DateTime($d['wednesday_opening']))
                ->setWednesdayClosing(new \DateTime($d['wednesday_closing']))
                ->setThursdayClosing(new \DateTime($d['thursday_opening']))
                ->setThursdayClosing(new \DateTime($d['thursday_closing']))
                ->setFridayOpening(new \DateTime($d['friday_opening']))
                ->setFridayClosing(new \DateTime($d['friday_closing']))
                ->setSaturdayOpening(new \DateTime($d['saturday_opening']))
                ->setSaturdayClosing(new \DateTime($d['saturday_closing']))
                ->setSundayOpening(new \DateTime($d['sunday_opening']))
                ->setSundayClosing(new \DateTime($d['sunday_closing']))
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
