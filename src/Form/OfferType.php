<?php

namespace App\Form;

use App\Entity\Offers;
use DateTime;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;

class OfferType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('title',TextType::class, [
            'label' => 'Titre de l\'enregistrement',
            'attr' => [
                'placeholder' =>  'Donnez un titre à cette annonce'
            ]
        ])            
        ->add('body',TextareaType::class, [
            'label' => 'Déscription',
            'attr' => [
                'placeholder' =>  'Écrivez une déscription à propos de votre besoin.'
            ]
        ])            
        ->add('budget', NumberType::class, [
            'label' => 'Budget',
            'attr' => [
                'placeholder' => 'Indiquer le nombre de moons que vous pourriez donner pour cet enregistrement'
            ]
        ])
        ->add('voice_type',ChoiceType::class, [
            'label' => 'Le style de voix',
            'choices' => [
                'Soprano' => 'Soprano',
                'Mezzo-Soprano' => 'Mezzo-Soprano',
                'Contralto' => 'Contralto',
                'Contre-Ténor' => 'Contre-Ténor',
                'Ténor' => 'Ténor',
                'Baryton' => 'Baryton',
                'Basse' => 'Basse'
            ]
        ])
        ->add('end_at', DateType::class, [
            'label' => 'Date de fin',
            'widget' => 'choice',
        ])
        ->add('submit', SubmitType::class, [
            'label' => 'Inscription',
            'attr' => [
                'class' => 'btn buttons btn-primary w-100 mt-4'
            ]
        ])
        ->add('agreeTerms', CheckboxType::class, [
            'mapped' => false,
            'label' => 'Accepter les conditions',
            'constraints' => [
                new IsTrue([
                    'message' => 'Vous devez accépter les conditions pour vous inscrire.',
                ]),
            ],
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Offers::class,
        ]);
    }
}
