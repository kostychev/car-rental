<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class CarRepository extends EntityRepository
{
    public function findAllWithModels()
    {
        return $this->createQueryBuilder('c')
            ->join('c.model', 'm')
            ->join('m.brand', 'b')
            ->select('c, m, b')
            ->getQuery()
            ->getResult();
    }
}
