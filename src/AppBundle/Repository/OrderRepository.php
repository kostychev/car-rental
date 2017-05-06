<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Car;
use Doctrine\ORM\EntityRepository;

class OrderRepository extends EntityRepository
{
    public function findHistory(Car $car = null)
    {
        $qb = $this->createQueryBuilder('o');

        $qb->select('o, office, cl, c, m, b')
            ->join('o.office', 'office')
            ->join('o.client', 'cl')
            ->join('o.car', 'c')
            ->join('c.model', 'm')
            ->join('m.brand', 'b');

        if (null !== $car) {
            $qb->andWhere('c.id = :car')
                ->setParameter('car', $car);
        }

        return $qb->getQuery()->getResult();
    }

    public function reportByDurationForOfficeAndBrand()
    {
        $sql = "SELECT b.name brand_name, of.name office_name, AVG(DATEDIFF(end_at, start_at)) AS duration
        FROM orders o
        JOIN cars c ON o.car_id = c.id
        JOIN models m ON c.model_id = m.id
        JOIN brands b ON m.brand_id = b.id
        JOIN offices of ON o.office_id = of.id
        GROUP BY b.name, of.name";

        return $this->getEntityManager()
            ->getConnection()
            ->fetchAll($sql);
    }
}
