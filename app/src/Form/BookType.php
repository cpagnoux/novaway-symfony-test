<?php

namespace App\Form;

use App\Entity\Book;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('isbn', null, [
                'label' => 'ISBN',
            ])
            ->add('title', null, [
                'label' => 'Titre',
            ])
            ->add('releaseDate', DateType::class, [
                'label' => 'Date de parution',
                'widget' => 'single_text',
            ])
            ->add('numPages', null, [
                'label' => 'Nombre de pages',
            ])
            ->add('summary', null, [
                'label' => 'Résumé',
            ])
            ->add('price', null, [
                'label' => 'Prix',
            ])
            ->add('author', null, [
                'choice_label' => 'name',
                'label' => 'Auteur',
                'placeholder' => 'Sélectionner',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}
