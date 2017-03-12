<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\Annotations\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use AppBundle\Entity\Patient;
use AppBundle\Entity\Personnel\Doctor;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use AppBundle\Controller\RestController;

class DoctorController extends RestController
{
  /**
   * @View(serializerGroups={"details"})
   */
  public function linkDoctorPatientAction(Doctor $doctor, Patient $patient) {
    $doctor->addPatient($patient);
    $patient->addDoctor($doctor);
    
    $em = $this->getDoctrine()->getManager();
    $em->persist($doctor);
    $em->persist($patient);
    
    try {
      $em->flush();
    } catch (UniqueConstraintViolationException $error) {
      throw new HttpException(
        409, 
        $this->msg('already_linked')
      );
    }
    
    $view = $this->view($doctor, 200);
    $view->setMsg($this->msg(
      'successfully_linked', 
      array($patient->getName(), $doctor->getName())
    ));
       
    return $this->handleView($view);
  }
}
