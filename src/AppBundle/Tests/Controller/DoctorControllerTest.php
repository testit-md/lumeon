<?php

namespace AppBundle\Tests\Controller;

use Liip\FunctionalTestBundle\Test\WebTestCase;

class DoctorControllerTest extends WebTestCase {  
  public function testLinkDoctorPatient() {
    $this->fixtures = $this->loadFixtures(array(
      'AppBundle\DataFixtures\ORM\LoadDoctorData',
      'AppBundle\DataFixtures\ORM\LoadPatientData'
    ))->getReferenceRepository();
    
    $translator = $this->getContainer()->get('translator');
    $doctor = $this->fixtures->getReference('doctor');
    $patient = $this->fixtures->getReference('patient');
    
    $client = $this->createClient();
    $client->request('LINK', sprintf(
      '/doctors/%d/patients/%d',
      $doctor->getId(),
      $patient->getId()
    ));
    
    $response = json_decode($client->getResponse()->getContent(), true);

    $this->assertSame(
        $response,
        array(
          'data' => array(
            'id' => $doctor->getId(),
            'name' => $doctor->getName(),
            'patients' => array(array(
              'id' => $patient->getId(),
              'name' => $patient->getName(),
              'dob' => $patient->getDob()->format(\DateTime::ISO8601),
              'gender' => $patient->getGender()
            ))
          ),
          'msg' => sprintf(
            $translator->trans('successfully_linked'), 
            $patient->getName(),
            $doctor->getName()
          ),
        )
    );
  }
}
