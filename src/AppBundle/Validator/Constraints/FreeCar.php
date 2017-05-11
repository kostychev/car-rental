<?php

namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * Проверка занятости авто.
 *
 * @Annotation
 */
class FreeCar extends Constraint
{
    public $message = 'В выбранный период времени авто занят.';

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}
