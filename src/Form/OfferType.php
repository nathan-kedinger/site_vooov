<?php

namespace App\Form;

use App\Entity\Offers;
use App\Repository\AudioRecordCategoriesRepository;
use App\Repository\VoiceStyleRepository;
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
    private VoiceStyleRepository $voiceStyleRepository;

    public function __construct(VoiceStyleRepository $voiceStyleRepository)
    {
        $this->voiceStyleRepository = $voiceStyleRepository;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('title',TextType::class, [
            'label' => 'Titre de l\'enregistrement',
            'attr' => [
                'class' => 'w-100 p-2 m-2',
                'placeholder' =>  'Donnez un titre à cette annonce'
            ]
        ])            
        ->add('body',TextareaType::class, [
            'label' => 'Déscription',
            'attr' => [
                'placeholder' =>  'Écrivez une déscription à propos de votre besoin.',
                'class' => 'w-100 p-2 m-2'
            ]
        ])            
        ->add('budget', NumberType::class, [
            'label' => 'Budget',
            'attr' => [
                'class' => 'w-100 p-2 m-2',
                'placeholder' => 'Indiquer le nombre de moons que vous pourriez donner pour cet enregistrement'
            ]
        ])
        ->add('voice_style',ChoiceType::class, [
            'label' => 'Le style de voix',
            'choices' => $this->voiceStyleRepository->getVoiceStyleChoices(),
            'attr' => [
                'class' => 'm-2'
            ]
        ])
            //Needs to be destroyed when this date is reached
        ->add('end_at', DateType::class, [
            'label' => 'Date de fin',
            'widget' => 'choice',
        ])
        ->add('submit', SubmitType::class, [
            'label' => 'Poster l\'annonce',
            'attr' => [
                'class' => 'btn buttons btn-primary w-50 mt-4'
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
