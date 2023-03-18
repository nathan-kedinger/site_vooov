<?php

namespace App\Form;

use App\Entity\AudioRecords;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AudioRecordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title',TextType::class, [
                'label' => 'Titre de l\'enregistrement',
                'attr' => [
                    'placeholder' =>  'Donnez un titre à cet enregistrement'
                ]

            ])
            ->add('voice_style',ChoiceType::class, [
                'label' => 'Le style de voix',
                'choices' => [
                    'Chant' => 'Chant',
                    'Culture' => 'Culture',
                    'Voix-Off' => 'Voix-Off',
                    'Humour' => 'Humour',
                    'Actualités' => 'Actualités'
                ]

            ])
            ->add('kind',ChoiceType::class, [
                'label' => 'Le style de voix',
                'choices' => [
                    'Soprano' => '1',
                    'Mezzo-Soprano' => 'Mezzo-Soprano',
                    'Contralto' => 'Contralto',
                    'Contre-Ténor' => 'Contre-Ténor',
                    'Ténor' => 'Ténor',
                    'Baryton' => 'Baryton',
                    'Basse' => 'Basse'
                ]

            ])
            ->add('description',TextareaType::class, [
                'label' => 'Déscription',
                'attr' => [
                    'placeholder' =>  'Écrivez une déscription à propos de cet enregistrement.'
                ]

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AudioRecords::class,
        ]);
    }
}
