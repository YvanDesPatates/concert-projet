<?php

namespace App\Form;

use App\Entity\ConcertHall;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConcertHallType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('seatCapacity')
            ->add('standingCapacity')
            ->add('renovationStartDate')
            ->add('renovationEndDate')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ConcertHall::class,
        ]);
    }
}
