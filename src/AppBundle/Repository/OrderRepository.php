<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Car;
use AppBundle\Entity\Order;
use Doctrine\ORM\EntityRepository;

class OrderRepository extends EntityRepository
{
    /**
     * Возвращает список зказов.
     *
     * @param Car|null $car
     * @return Order[]
     */
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

    /**
     * Проверка по заказам, что авто свободен на указанный период времени.
     *
     * @param Car $car
     * @param \DateTime $start
     * @param \DateTime $end
     * @return bool
     */
    public function carIsFreeForRent(Car $car, \DateTime $start, \DateTime $end)
    {
        // кол-во пересеканиий
        $count = (int)$this->createQueryBuilder('o')
            ->where('o.car = :car')
            ->andWhere('o.startAt <= :end AND o.endAt >= :start')
            ->select('COUNT(o.id)')
            ->setParameters([
                'car'   => $car,
                'start' => $start,
                'end'   => $end,
            ])
            ->getQuery()
            ->getSingleScalarResult();

        return $count === 0;
    }

    /**
     * Отчет о средней продолжительности проката.
     *
     * @return array
     */
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
