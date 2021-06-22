<?php

namespace ServiceApresVenteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Reclamation
 *
 * @ORM\Table(name="reclamation")
 * @ORM\Entity(repositoryClass="ServiceApresVenteBundle\Repository\ReclamationRepository")
 */
class Reclamation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_rec", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idRec;

    /**
     * @ORM\ManyToOne(targetEntity="AchatBundle\Entity\ProduitCommande")
     * @ORM\JoinColumns(
     *      @ORM\JoinColumn(name="idpc", referencedColumnName="id"),
     *      @ORM\JoinColumn(name="pc", referencedColumnName="id_commande",name="pc")
     *)
     */
    private $produitCommande;





    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(name="iduser", referencedColumnName="id")
     */

    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="objet", type="string", length=50, nullable=false)
     * @Assert\NotBlank(message="S'il vous plait inserer objet")
     *  * @Assert\Length(
     *     min=5,
     *     max=90,
     *     minMessage="l'objet doit etre au minimum  5 caractere",
     *     maxMessage="l'objet doit etre au minimum  90 caractere"
     * )
     */
    private $objet;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=1000, nullable=false)
     *  * @Assert\NotBlank(message="S'il vous plait inserer description")
     *  * @Assert\Length(
     *     min=10,
     *     max=500,
     *     minMessage="la description doit etre au minimum  10 caractere",
     *     maxMessage="la description doit etre au minimum  500 caractere"
     * )
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="etat", type="integer", nullable=false)
     */
    private $etat;



    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;




    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=false)
     */
    private $image;

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

    /**
     *
     * @ORM\ManyToOne(targetEntity="RecFeedCat")
     * @ORM\JoinColumn(name="cat" ,referencedColumnName="id_cat" ,nullable=true, onDelete="CASCADE")
     */
    private $idc;

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getProduitCommande()
    {
        return $this->produitCommande;
    }

    /**
     * @param mixed $produitCommande
     */
    public function setProduitCommande($produitCommande)
    {
        $this->produitCommande = $produitCommande;
    }

    /**
     * @return mixed
     */
    public function getReclamationCat()
    {
        return $this->reclamationCat;
    }

    /**
     * @param mixed $reclamationCat
     */
    public function setReclamationCat($reclamationCat)
    {
        $this->reclamationCat = $reclamationCat;
    }




    /**
     * @return int
     */
    public function getIdRec()
    {
        return $this->idRec;
    }

    /**
     * @param int $idRec
     */
    public function setIdRec($idRec)
    {
        $this->idRec = $idRec;
    }

    /**
     * @return string
     */
    public function getObjet()
    {
        return $this->objet;
    }

    /**
     * @param string $objet
     */
    public function setObjet($objet)
    {
        $this->objet = $objet;
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
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * @param int $etat
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
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




}