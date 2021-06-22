<?php


namespace VenteBundle\Repository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\EntityRepository;

class ProduitRepository extends EntityRepository
{
    public function  myfindbyid()
    { $Query=$this->getEntityManager()->
    createQuery("select p from VenteBundle:Produit p ")
        ->getResult();

    }

    public function findEntitiesByString($str){
        return $this->getEntityManager()
            ->createQuery(
                'SELECT e
                FROM VenteBundle:Produit e
                WHERE e.libelle LIKE :str'
            )
            ->setParameter('str', '%'.$str.'%')
            ->getResult();
    }

    public function findbyMe($id)
    {
             $Query=$this->getEntityManager()
            ->createQuery("SELECT l FROM VenteBundle:Produit l WHERE l.id=:id ")
                 ->setParameter('id',$id);
            return $Query->getResult();

    }
    public function findbyMe3()
    {
        $Query=$this->getEntityManager()
            ->createQuery("SELECT l FROM VenteBundle:Produit l 
         order by l.prix DESC ");

        return $Query->getResult();

    }
    public function findbyMeAsc()
    {
        $Query=$this->getEntityManager()
            ->createQuery("SELECT l FROM VenteBundle:Produit l 
         order by l.prix ASC ");

        return $Query->getResult();

    }
    public function findtotal()
    {
        $Query=$this->getEntityManager()
            ->createQuery("SELECT count(l.id) FROM VenteBundle:Produit l 
         ");

        try {
            return $Query->getSingleScalarResult();
        } catch (NoResultException $e) {
        } catch (NonUniqueResultException $e) {
        }

    }

}