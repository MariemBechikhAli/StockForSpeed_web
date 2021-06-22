<?php

namespace ServiceApresVenteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Feedback
 *
 * @ORM\Table(name="feedback")
 * @ORM\Entity(repositoryClass="ServiceApresVenteBundle\Repository\FeedbackRepository")
 */
class Feedback
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_feed", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idFeed;



    /**
     * @var string
     * @Assert\NotBlank(message="le champs Description est obligatoire")
     * @ORM\Column(name="description", type="string", length=400, nullable=false)
     */
    private $description;

    /**
     * @var integer
     * @Assert\NotBlank(message="note est obligatoire")
     * @ORM\Column(name="note", type="integer", nullable=false)
     */
    private $note;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=true)
     */
    private $id;

    /**
     * @return \DateTime
     */
    public function getDatefeedback()
    {
        return $this->datefeedback;
    }

    /**
     * @param \DateTime $datefeedback
     */
    public function setDatefeedback($datefeedback)
    {
        $this->datefeedback = $datefeedback;
    }

    /**
     * @var string
     * @Assert\File(maxSize="500k", mimeTypes={"image/jpeg", "image/jpg", "image/png", "image/GIF"})
     * @ORM\Column(name="image", type="string", length=100, nullable=false)
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="id_commande", type="string", length=100, nullable=true)
     */
    private $idCommande;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateannonce", type="date")
     */
    private $datefeedback;

    /**
     *
     * @ORM\ManyToOne(targetEntity="RecFeedCat")
     * @ORM\JoinColumn(name="cat",referencedColumnName="id_cat")
     */
    private $idc;

    public function __toString()
    {
        return $this->idc;
    }

    /**
     * @return int
     */
    public function getIdFeed()
    {
        return $this->idFeed;
    }

    /**
     * @param int $idFeed
     */
    public function setIdFeed($idFeed)
    {
        $this->idFeed = $idFeed;
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
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @param int $note
     */
    public function setNote($note)
    {
        $this->note = $note;
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
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return string
     */
    public function getIdCommande()
    {
        return $this->idCommande;
    }

    /**
     * @param string $idCommande
     */
    public function setIdCommande($idCommande)
    {
        $this->idCommande = $idCommande;
    }

    /**
     * @return mixed
     */
    public function getIdc()
    {
        return $this->idc;
    }

    /**
     * @param mixed $idc
     */
    public function setIdc($idc)
    {
        $this->idc = $idc;
    }




}