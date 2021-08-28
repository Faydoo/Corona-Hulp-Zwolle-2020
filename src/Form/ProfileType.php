<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Location;
use App\Entity\Profile;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfileType extends AbstractType
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
            ->add('firstName', TextType::class,
                [
                    'label' => false,
                    'attr' => [
                        'class' =>  'form-control'
                    ]
                ])
            ->add('lastName', TextType::class,
                [
                    'label' => false,
                    'attr' => [
                        'class' =>  'form-control'
                    ]
                ])
            ->add('street', TextType::class,
                [
                    'label' => false,
                    'attr' => [
                        'class' =>  'form-control'
                    ]
                ])
            ->add('number',TextType::class,
                [
                    'label' => false,
                    'attr' => [
                        'class' =>  'form-control'
                    ]
                ])
            ->add('postalCode', TextType::class,
                [
                    'label' => false,
                    'attr' => [
                        'class' =>  'form-control'
                    ]
                ])
            ->add('city', TextType::class,
                [
                    'label' => false,
                    'attr' => [
                        'class' =>  'form-control'
                    ]
                ])
            ->add('telnum', TextType::class,
                [
                    'label' => false,
                    'attr' => [
                        'class' =>  'form-control'
                    ]
                ])
            ->add('helpOfferedTitle',TextType::class,
                [
                    'label' => false,
                    'attr' => [
                        'class' =>  'form-control'
                    ]
                ])
            ->add('helpOfferedText',TextareaType::class,
                [
                    'label' => false,
                    'attr' => [
                        'class' =>  'form-control'
                    ]
                ])
            ->add('visible', CheckboxType::class,
                [
                    'label' => false,
                    'attr' => [
                        'class' =>  'form-control'
                    ]
                ])
            ->add('category', EntityType::class,
                [
                    'class' => Category::class,
                    'label' => false,
                    'attr' => [
                        'class' =>  'form-control'
                    ]
                ])
            ->add('location', EntityType::class,
                [
                    'class' => Location::class,
                    'label' => false,
                    'attr' => [
                        'class' =>  'form-control'
                    ]
                ])
            ->add('save', SubmitType::class, [
                'label' => 'Opslaan',
                'attr' => [
                    'class' => 'btn btn-block btn-success mt-3'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Profile::class,
        ]);
    }
}