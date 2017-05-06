<?php

namespace AppBundle\Form;

use AppBundle\Entity\Car;
use AppBundle\Entity\Model;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CarType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('model', EntityType::class, [
                'class' => Model::class,
                'choice_label' => function (Model $model) {
                    return$model->getBrand()->getName().' '. $model->getName();
                },
            ])
            ->add('number');
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Car::class,
        ]);
    }
}
