<?php

namespace ServiceApresVenteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * RecFeedCat
 *
 * @ORM\Table(name="rec_feed_cat")
 * @ORM\Entity
 */
class RecFeedCat
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_cat", type="integer",nullable=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id_cat;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="nom", type="string", length=50, nullable=false)
     */
    private $nom;



    /**
     * @var string
     * @Assert\File(maxSize="500k", mimeTypes={"image/jpeg", "image/jpg", "image/png", "image/GIF"})
     * @ORM\Column(name="image", type="string", length=100, nullable=false)
     */
    private $image;



    /**
     * @return int
     */
    public function getIdCat()
    {
        return $this->id_cat;
    }

    /**
     * @param int $id_cat
     */
    public function setIdCat($id_cat)
    {
        $this->id_cat = $id_cat;
    }

    public function __toString()

    {
        return (string)$this->id_cat;
    }




    /**
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
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



}