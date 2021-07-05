<?php


namespace App\Form\Type;


use App\Entity\Booking;
use App\Entity\Equipment;
use App\Entity\Station;
use App\Entity\Van;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotNull;

class BookingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('van', EntityType::class, [
                'class' => Van::class,
                'constraints' => [
                    new NotNull(),
                ],
            ])
            ->add('startStation', EntityType::class, [
                'class' => Station::class,
                'constraints' => [
                    new NotNull(),
                ],
            ])
            ->add('endStation', EntityType::class, [
                'class' => Station::class,
                'constraints' => [
                    new NotNull(),
                ],
            ])
            ->add('startDate', DateTimeType::class, [
                'widget' => 'single_text',
                'constraints' => [
                    new NotNull(),
                ],
            ])
            ->add('endDate', DateTimeType::class, [
                'widget' => 'single_text',
                'constraints' => [
                    new NotNull(),
                ],
            ])
            ->add('equipments', EntityType::class, [
                'class' => Equipment::class,
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Booking::class,
        ]);
    }


}