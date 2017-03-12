<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Personnel\Doctor;

class LoadDoctorData extends AbstractFixture implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $mainDoctor = new Doctor();
        $mainDoctor->setName('Dr. Isaacs');
        
        $this->setReference('doctor', $mainDoctor);

        $manager->persist($mainDoctor);
        $manager->flush();
    }
}