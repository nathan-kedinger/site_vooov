<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SendMoonsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('roles')
            ->add('password')
            ->add('isVerified')
            ->add('uuid')
            ->add('pseudo')
            ->add('name')
            ->add('firstname')
            ->add('birthday')
            ->add('phone')
            ->add('description')
            ->add('number_of_followers')
            ->add('number_of_moons')
            ->add('number_of_friends')
            ->add('url_profile_picture')
            ->add('sign_in')
            ->add('last_connection')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
