<?php

namespace VehiculeBundle\Repository;

use Doctrine\ORM\EntityRepository;
class VehiculeRepository extends EntityRepository
{
    /**
     * @param string $matricule
     *
     * @return array
     */
    public function findLike($matricule)
    {
        $dq=$this->getEntityManager()
            ->createQuery("select v from VehiculeBundle:Vehicule v where v.matricule = '$matricule'");
       // $dq = $this
         //   ->createQueryBuilder('v')
           // ->where('v.matricule LIKE :matricule')
            //->setParameter( 'matricule', $matricule)
            //->orderBy('v.matricule')
            //->setMaxResults(1)
            //->getQuery()
            //->execute()
        ;
        return$qr= $dq->getResult();
    }

}
?>