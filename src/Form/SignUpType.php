<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SignUpType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('displayName', TextType::class,
                [
                    'label' => false,
                    'attr' => [
                        'class' =>  'form-control'
                    ]
                ])
            ->add('email', EmailType::class,
                [
                    'label' => false,
                    'attr' => [
                        'class' =>  'form-control'
                    ]
                ])
            ->add('plainPassword', RepeatedType::class,
                [
                    'type' => PasswordType::class,
                    'first_options'  => [ 'label' => false, 'attr' => [ 'class' =>  'form-control']],
                    'second_options' => [ 'label' => false, 'attr' => [ 'class' =>  'form-control']],
                    'invalid_message' => 'Beide wachtwoorden komen niet overeen'
                ])
            ->add('signup', SubmitType::class, [
                'label' => 'Aanmelden',
                'attr' => [
                    'class' => 'btn btn-success'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => User::class,
        ));
    }
}
