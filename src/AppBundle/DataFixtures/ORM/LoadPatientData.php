<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Patient;

class LoadPatientData extends AbstractFixture implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $firstPatient = new Patient();
        $firstPatient->setName('Alice');
        $firstPatient->setGender(Patient::GENDER_FEMALE);
        $firstPatient->setDob(new \DateTime('2002-03-15'));

        $this->setReference('patient', $firstPatient);
        
        $manager->persist($firstPatient);
        $manager->flush();
    }
}