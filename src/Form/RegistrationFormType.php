<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('firstname', TextType::class, [
                'label' => 'Votre prénom',
                'constraints' => new Length([
                    'min' => 2,
                    'max' => 30,
                ]),
                'attr' => [
                    'placeholder' => 'Saisissez votre prénom',
                    'class' => 'w-100'

                ]
            ])
            ->add('name', TextType::class, [
                'label' => 'Votre nom',
                'constraints' => new Length([
                    'min' => 2,
                    'max' => 30,
                ]),
                'attr' => [
                    'placeholder' => 'Saisissez votre nom',
                    'class' => 'w-100'

                ]
            ])
            ->add('pseudo', TextType::class, [
                'label' => 'Votre pseudo',
                'constraints' => new Length([
                    'min' => 2,
                    'max' => 22,
                ]),
                'attr' => [
                    'placeholder' => 'Saisissez votre pseudo',
                    'class' => 'w-100'

                ]
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => [
                    'label' => 'Mot de passe',
                    'attr' => [
                        'placeholder' =>'Saisissez votre mot de passe',
                        'class' => 'w-100'

                        ]
                ],
                'second_options' => [
                    'label' => 'Confirmation de mot de passe',
                    'attr' => [
                        'placeholder' =>'Confirmez votre mot de passe',
                        'class' => 'w-100'

                        ]
                ],
                    'constraints' => new Length([
                    'min' => 4,
                    'max' => 30,
                ]),
            ])
            ->add('phone', TelType::class, [
                'label' => 'Un numéro de téléphone',
                'attr' => [
                    'placeholder' => 'Saisissez votre numéro de téléphone',
                    'class' => 'w-100'

                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'Votre email',
                'constraints' => new Length([
                    'min' => 5,
                    'max' => 60,
                ]),
                'attr' => [
                    'placeholder' => 'Saisissez votre email',
                    'class' => 'w-100'
                ]
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
            'data_class' => Users::class,
        ]);
    }
}
