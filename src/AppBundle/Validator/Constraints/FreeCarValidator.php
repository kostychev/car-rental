<?php

namespace AppBundle\Validator\Constraints;

use AppBundle\Entity\Order;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class FreeCarValidator extends ConstraintValidator
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Checks if the passed value is valid.
     *
     * @param Order $order The value that should be validated
     * @param Constraint $constraint The constraint for the validation
     */
    public function validate($order, Constraint $constraint)
    {
        $carIsFree = $this->entityManager
            ->getRepository(Order::class)
            ->carIsFreeForRent(
                $order->getCar(),
                $order->getStartAt(),
                $order->getEndAt()
            );

        if (!$carIsFree) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}
