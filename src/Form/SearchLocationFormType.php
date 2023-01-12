<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchLocationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('location', TextType::class, [
                'attr' => [
                    'placeholder' => 'City, State or Airport Code',
                    'class' => 'OUAISOUAIS'
                ],

                'label_attr' => [
                    'class' => 'input_title text-white'
                ]
            ])
            ->add('date', DateType::class, [
                'widget' => 'single_text',

                // prevents rendering it as type="date", to avoid HTML5 date pickers
                'html5' => true,

                'label_attr' => [
                    'class' => 'input_title text-white',
                ],
            ])
            ->add('returnLocation', TextType::class, [
                'attr' => [
                    'placeholder' => 'City, State or Airport Code',
                ],

                'label_attr' => [
                    'class' => 'input_title text-white'
                ],
                'required'=>false
            ])
            ->add('returnDate', DateType::class, [
                'widget' => 'single_text',

                // prevents rendering it as type="date", to avoid HTML5 date pickers
                'html5' => true,

                'label_attr' => [
                    'class' => 'input_title text-white',
                ],
            ])
            ->add('price', TextType::class, [
                'label_attr' => [
                    'class' => 'input_title text-white'
                ],
                'attr' => [
                    'id' => 'amount',
                    'class' => 'price-text',
                    'readonly' => ''
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
