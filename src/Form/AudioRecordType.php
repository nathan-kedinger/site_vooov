<?php

namespace App\Form;

use App\Entity\AudioRecords;
use App\Entity\AudioRecordCategories;
use App\Repository\AudioRecordCategoriesRepository;
use App\Repository\VoiceStyleRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AudioRecordType extends AbstractType
{
    private AudioRecordCategoriesRepository $categoriesRepository;
    private VoiceStyleRepository $voiceStyleRepository;

    public function __construct(AudioRecordCategoriesRepository $categoriesRepository, VoiceStyleRepository $voiceStyleRepository)
    {
        $this->categoriesRepository = $categoriesRepository;
        $this->voiceStyleRepository = $voiceStyleRepository;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title',TextType::class, [
                'label' => 'Titre de l\'enregistrement',
                'attr' => [
                    'class' => 'm-2',
                    'placeholder' =>  'Donnez un titre à cet enregistrement'
                ]
            ])
            ->add('voice_style', ChoiceType::class, [
                'choices' => $this->voiceStyleRepository->getVoiceStyleChoices(),
                'attr' => [
                    'class' => 'm-2'
                ]
            ])
            ->add('categories', ChoiceType::class, [
                'choices' => $this->categoriesRepository->getCategoriesChoices(),
                'label' => 'Catégorie',
                'attr' => [
                    'class' => 'm-2'
                ]
            ])
            ->add('description',TextareaType::class, [
                'label' => 'Description',
                'attr' => [
                    'class' => 'm-2 form-control',
                    'placeholder' =>  'Écrivez une description à propos de cet enregistrement.'
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
