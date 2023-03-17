<?php

namespace App\Form;

use App\Entity\AudioRecords;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ResearchRecordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('title',TextType::class, [
            'label' => null,
            'attr' => [
            'class' => 'form-control me-2 search-bar align-self-center border-radius-25',
            'placeholder' =>  'Rechercher un enregistrement'
            ]
        ])
        ->add('recherche', SubmitType::class, [
            'attr' => [
                'class' => 'btn btn-primary'
            ]
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AudioRecords::class,
            'method' =>'GET',
            'csrf_protection' => false
        ]);
    }
}