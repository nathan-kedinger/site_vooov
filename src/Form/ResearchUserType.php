<?php

namespace App\Form;

use App\Classes\SearchUser;
use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ResearchUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('string', TextType::class, [
            'label' => false,
            'required' => false,
            'attr' => [
                'class' => 'form-control',
                'placeholder' => 'Entrez un mot-clé'
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
            'data_class' => SearchUser::class,
        ]);
    }
}
