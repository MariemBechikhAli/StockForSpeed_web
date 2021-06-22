<?php

namespace LivraisonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Facture
 *
 * @ORM\Table(name="facture")
 * @ORM\Entity
 */
class Facture
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_facture", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idFacture;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_livraison", type="integer", nullable=true)
     */
    private $idLivraison;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_commande", type="integer", nullable=true)
     */
    private $idCommande;

    /**
     * @var string
     *
     * @ORM\Column(name="type_paiement", type="string", length=100, nullable=true)
     */
    private $typePaiement;

    /**
     * @var string
     *
     * @ORM\Column(name="type_facture", type="string", length=100, nullable=true)
     */
    private $typeFacture;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;


}

