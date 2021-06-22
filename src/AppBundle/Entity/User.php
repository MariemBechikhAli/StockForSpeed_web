<?php

// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends \FOS\UserBundle\Model\User
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @var string
     *
     * @ORM\Column(name="activite", type="string", length=200, nullable=true)
     */
    private $activite;

    /**
     * @var integer
     *
     * @ORM\Column(name="telephone", type="integer", nullable=true)
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=1000, nullable=true)
     */
    private $adresse;

    /**
     * @var string
     *@Assert\File(maxSize="500K")
     * @ORM\Column(name="photo", type="string", length=1000, nullable=true)
     */
    public $photo;
    /**
     * @var string
     *
     * @ORM\Column(name="Mission", type="string", length=50, nullable=true)
     */

    private $mission;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="Date_Naissance", type="date", nullable=true)
     */
    public $dateNaissance;

    /**
     * @var string
     *
     * @ORM\Column(name="Prenom", type="string", length=20, nullable=true)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="Note", type="string", length=20, nullable=true)
     */
    private $note;

    /**
     * @var string
     *
     * @ORM\Column(name="governat", type="string", length=20, nullable=true)
     */
    private $governat;

    /**
     * @var string
     *
     * @ORM\Column(name="etat", type="string", length=50, nullable=true)
     */
    private $etat;

    /**
     * @var string
     *
     * @ORM\Column(name="cin", type="string", length=50, nullable=false)
     */
    private $cin;

    /**
     * @var string
     *
     * @ORM\Column(name="disponible", type="string", length=50, nullable=true)
     */
    private $disponible;

    /**
     * @return string
     */
    public function getGovernat()
    {
        return $this->governat;
    }

    /**
     * @param string $governat
     */
    public function setGovernat($governat)
    {
        $this->governat = $governat;
    }



    /**
     * @return mixed
     */
    public function getwebPath()
    {
        return null===$this->photo ? null : $this->getUploadDir().'/' .$this->photo;
    }
    protected function getUploadRootDir(){
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir(){
        return 'photo';
    }





    public function UploadProfilePicture(){
        $this->file->move($this->getUploadRootDir(), $this->file->getClientOriginalName());
        $this->photo=$this->file->getClientOriginalName();
        $this->file=null;
    }

    /**
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param string $photo
     */
    public function setPhoto(string $photo)
    {
        $this->photo = $photo;
    }




    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

}
