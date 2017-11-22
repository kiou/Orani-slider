<?php

namespace SliderBundle\Repository;

/**
 * SliderRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SliderRepository extends \Doctrine\ORM\EntityRepository
{
    public function getAllSliders($recherche)
    {
        $qb = $this->createQueryBuilder('s');

        /**
         * recherche via le username
         */
        if(!is_null($recherche)){
            $qb->andWhere('s.titre LIKE :titre')
                ->setParameter('titre', '%'.$recherche.'%');
        }

        $qb->orderBy('s.id', 'DESC');

        return $query = $qb->getQuery()->getResult();
    }
}