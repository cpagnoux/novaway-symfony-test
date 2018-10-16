<?php

namespace App\Form;

use App\Entity\Bluray;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BlurayType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('isan')
            ->add('title')
            ->add('releaseDate', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('duration')
            ->add('storyline')
            ->add('price')
            ->add('director', null, [
                'choice_label' => 'name',
                'placeholder' => 'Choose an option',
            ])
            ->add('actors', null, [
                'choice_label' => 'name',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Bluray::class,
        ]);
    }
}
