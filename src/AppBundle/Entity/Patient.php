<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Entity\Personnel\Doctor;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Exclude;

/**
 * Doctor
 *
 * @ORM\Table(name="patient")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PatientRepository")
 */
class Patient
{
	const GENDER_MALE = 1;
	const GENDER_FEMALE = 2;
	const GENDER_OTHER = 3;

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
	 * @var string
	 *
	 * @Groups({"details"})
	 * 
	 * @ORM\Column(name="dob", type="datetime", nullable=false)
	 */
	private $dob;
	
	/**
	 * @var string
	 *
	 * @Groups({"details"})
	 * 
	 * @ORM\Column(name="gender", type="integer", nullable=false, options={"unsigned": true})
	 */
	private $gender;
	
	/** @var  Hospital */
	private $hospital;
	
	/**
	 * @var Doctor[]
	 *
	 * @Exclude
	 * 
	 * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Personnel\Doctor")
	 * @ORM\JoinTable(name="patients_doctor",
	 *      joinColumns={@ORM\JoinColumn(name="patient_id", referencedColumnName="id")},
	 *      inverseJoinColumns={@ORM\JoinColumn(name="doctor_id", referencedColumnName="id")}
	 *      )
	 */
	private $doctors;

	public function __construct() {
		$this->doctors = new ArrayCollection();
	}

	/**
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @param int $id
	 * @return Patient
	 */
	public function setId($id)
	{
		$this->id = $id;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @param string $name
	 * @return Patient
	 */
	public function setName($name)
	{
		$this->name = $name;
		return $this;
	}

	/**
	 * @return \DateTime
	 */
	public function getDob()
	{
		return $this->dob;
	}

	/**
	 * @param \DateTime $dob
	 * @return Patient
	 */
	public function setDob($dob)
	{
		$this->dob = $dob;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getGender()
	{
		return $this->gender;
	}

	/**
	 * @param string $gender
	 * @return Patient
	 */
	public function setGender($gender)
	{
		$this->gender = $gender;
		return $this;
	}

	/**
	 * @return Hospital
	 */
	public function getHospital()
	{
		return $this->hospital;
	}

	/**
	 * @param Hospital $hospital
	 * @return Patient
	 */
	public function setHospital($hospital)
	{
		$this->hospital = $hospital;
		return $this;
	}

	/**
	 * Add a patient
	 *
	 * @param Doctor $doctor
	 *
	 * @return Patient
	 */
	public function addDoctor(Doctor $doctor)
	{
			$this->doctors[] = $doctor;
			
			return $this;
	}

	/**
	 * Get patients
	 *
	 * @return Doctor[] 
	 */
	public function getDoctors()
	{
			return $this->doctors;
	}
}