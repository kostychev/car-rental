<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Заказ
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OrderRepository")
 * @ORM\Table(name="orders")
 */
class Order
{
    const STATUS_NEW = 'new';
    const STATUS_RESERVED = 'reserved';
    const STATUS_RETURNED = 'returned';
    const STATUS_CANCELED = 'canceled';

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start_at", type="datetime")
     */
    private $startAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end_at", type="datetime")
     */
    private $endAt;

    /**
     * @var Office
     *
     * @ORM\ManyToOne(targetEntity="Office")
     * @ORM\JoinColumn(nullable=false)
     */
    private $office;

    /**
     * @var Client
     *
     * @ORM\ManyToOne(targetEntity="Client")
     * @ORM\JoinColumn(nullable=false)
     */
    private $client;

    /**
     * @var Car
     *
     * @ORM\ManyToOne(targetEntity="Car")
     * @ORM\JoinColumn(nullable=false)
     */
    private $car;

    /**
     * @var Office
     *
     * @ORM\ManyToOne(targetEntity="Office")
     */
    private $returnOffice;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set startAt
     *
     * @param \DateTime $startAt
     *
     * @return Order
     */
    public function setStartAt($startAt)
    {
        $this->startAt = $startAt;

        return $this;
    }

    /**
     * Get startAt
     *
     * @return \DateTime
     */
    public function getStartAt()
    {
        return $this->startAt;
    }

    /**
     * Set endAt
     *
     * @param \DateTime $endAt
     *
     * @return Order
     */
    public function setEndAt($endAt)
    {
        $this->endAt = $endAt;

        return $this;
    }

    /**
     * Get endAt
     *
     * @return \DateTime
     */
    public function getEndAt()
    {
        return $this->endAt;
    }

    /**
     * Set office
     *
     * @param Office $office
     *
     * @return Order
     */
    public function setOffice(Office $office)
    {
        $this->office = $office;

        return $this;
    }

    /**
     * Get office
     *
     * @return Office
     */
    public function getOffice()
    {
        return $this->office;
    }

    /**
     * Set client
     *
     * @param Client $client
     *
     * @return Order
     */
    public function setClient(Client $client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set car
     *
     * @param Car $car
     *
     * @return Order
     */
    public function setCar(Car $car)
    {
        $this->car = $car;

        return $this;
    }

    /**
     * Get car
     *
     * @return Car
     */
    public function getCar()
    {
        return $this->car;
    }

    /**
     * Set returnOffice
     *
     * @param Office $returnOffice
     *
     * @return Order
     */
    public function setReturnOffice(Office $returnOffice = null)
    {
        $this->returnOffice = $returnOffice;

        return $this;
    }

    /**
     * Get returnOffice
     *
     * @return Office
     */
    public function getReturnOffice()
    {
        return $this->returnOffice;
    }
}
