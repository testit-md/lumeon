<?php

namespace AppBundle\Entity\Personnel;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Patient;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation\Groups;

/**
 * Doctor
 *
 * @ORM\Table(name="personnel_doctor")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Personnel\DoctorRepository")
 */
class Doctor
{
    /**
     * @var int
     *
     * @Groups({"details"})
     * 
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @Groups({"details"})
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var Patient[]
     *
     * @Groups({"details"})
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Patient")
     * @ORM\JoinTable(name="doctor_patients",
     *      joinColumns={@ORM\JoinColumn(name="doctor_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="patient_id", referencedColumnName="id")}
     *      )
     */
    private $patients;

    public function __construct() {
        $this->patients = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Doctor
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add a patient
     *
     * @param Patient $patient
     *
     * @return Doctor
     */
    public function addPatient(Patient $patient)
    {
        $this->patients[] = $patient;
        
        return $this;
    }

    /**
     * Get patients
     *
     * @return Patient[] 
     */
    public function getPatients()
    {
        return $this->patients;
    }
}
