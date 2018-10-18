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
            ->add('isan', null, [
                'label' => 'ISAN',
            ])
            ->add('title', null, [
                'label' => 'Titre',
            ])
            ->add('releaseDate', DateType::class, [
                'label' => 'Date de sortie',
                'widget' => 'single_text',
            ])
            ->add('duration', null, [
                'label' => 'Durée',
            ])
            ->add('storyline', null, [
                'label' => 'Résumé',
            ])
            ->add('price', null, [
                'label' => 'Prix',
            ])
            ->add('director', null, [
                'choice_label' => 'name',
                'label' => 'Réalisateur',
                'placeholder' => 'Sélectionner',
            ])
            ->add('actors', null, [
                'choice_label' => 'name',
                'label' => 'Acteurs',
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
