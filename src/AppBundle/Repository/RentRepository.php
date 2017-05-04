<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Car;
use Doctrine\ORM\EntityRepository;
use const null;

class RentRepository extends EntityRepository
{
    public function findHistory(Car $car = null)
    {
        $qb = $this->createQueryBuilder('r');

        $qb->select('r, cl, c, m, b')
            ->join('r.office', 'o')
            ->join('r.client', 'cl')
            ->join('r.car', 'c')
            ->join('c.model', 'm')
            ->join('m.brand', 'b')
            ;

        if (null !== $car) {
            $qb->andWhere('c.id = :car')
                ->setParameter('car', $car);
        }

        return $qb->getQuery()->getResult();
    }
}
