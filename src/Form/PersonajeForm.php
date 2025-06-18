<?php

namespace App\Form;

use App\Entity\Personaje;
use App\Entity\Planeta;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonajeForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('ki')
            ->add('maxKi')
            ->add('race')
            ->add('gender')
            ->add('description')
            ->add('image')
            ->add('affiliation')
            ->add('deletedAt')
            ->add('planeta', EntityType::class, [
                'class' => Planeta::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Personaje::class,
        ]);
    }
}
