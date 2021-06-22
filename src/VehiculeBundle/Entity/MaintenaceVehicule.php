<?php

namespace VehiculeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * MaintenaceVehicule
 *
 * @ORM\Table(name="maintenace_vehicule")
 * @ORM\Entity
 */
class MaintenaceVehicule
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     * @Assert\NotBlank(message="Le Champs matricule est obligatoire")
     * @Assert\Length(min=5,max=50)
     * @ORM\Column(name="nature", type="string", length=255, nullable=true)
     */
    private $nature;

    /**
     * @var \DateTime
     *  @Assert\Date
     * @Assert\GreaterThanOrEqual("today")
     *  @Assert\NotBlank(message="Veuillez svp remplir la date de l'entretien")
     * @ORM\Column(name="date", type="date", nullable=true)
     */
    private $date;

    /**
     * @var string
     *@Assert\NotBlank(message="Le Champs description est obligatoire")
     * @Assert\Length(min=5,max=50)
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     */
    private $description;

    /**
     * @var integer
   * @Assert\NotBlank(message="Veuiller tapez le cout")
     * @Assert\Length(min=2,max=50)
     * @ORM\Column(name="cout", type="integer", nullable=true)
     */
    private $cout;


    /**
     * @ORM\ManyToOne(targetEntity="VehiculeBundle\Entity\Vehicule")
     * @ORM\JoinColumn(name="matricule",
    referencedColumnName="matricule")
     * @var string
     */
    private $vehicule;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getNature()
    {
        return $this->nature;
    }

    /**
     * @param string $nature
     */
    public function setNature($nature)
    {
        $this->nature = $nature;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return int
     */
    public function getCout()
    {
        return $this->cout;
    }

    /**
     * @param int $cout
     */
    public function setCout($cout)
    {
        $this->cout = $cout;
    }

    /**
     * @return mixed
     */
    public function getVehicule()
    {
        return $this->vehicule;
    }

    /**
     * @param mixed $vehicule
     */
    public function setVehicule($vehicule)
    {
        $this->vehicule = $vehicule;
    }


}

