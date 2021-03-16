<?php

namespace App\Form;

use App\Entity\Dinosaur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DinosaurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('weight')
            ->add('height')
            ->add('lenght')
            ->add('top_speed')
            ->add('top')
            ->add('img')
            ->add('info')
            ->add('period')
            ->add('diet')
            ->add('continent')
            ->add('users')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Dinosaur::class,
        ]);
    }
}
