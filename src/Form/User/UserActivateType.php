<?php

namespace App\Form\User;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class UserActivateType extends AbstractType{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('growth', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Wzrost'
            ])
            ->add('physique', ChoiceType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Sylwetka',
                'choices' => [
                    'Wysportowana' => 'Wysportowana',
                    'Przeciętna' => 'Przeciętna',
                    'Szczupła' => 'Szczupła',
                    'Nadwaga' => 'Nadwaga'
                ]
            ])
            ->add('hair_length', ChoiceType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Włosy',
                'choices' => [
                    'Krótkie' => 'Krótkie',
                    'Długie' => 'Długie',
                    'Z grzywką' => 'Z grzywką',
                    'Loczki' => 'Loczki',
                    'Warkoczyki' => 'Warkoczyki',
                    'Brak' => 'Brak'
                ]
            ])
            ->add('hair_color', ChoiceType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Kolor włosów',
                'choices' => [
                    'Brązowe' => 'Brązowe',
                    'Czarne' => 'Czarne',
                    'Blond' => 'blond',
                    'Kolorowe' => 'Kolorowe',
                    'Siwe' => 'Siwe',
                    'Brak' => 'Brak'
                ]
            ])
            ->add('eye_color', ChoiceType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Kolor oczu',
                'choices' => [
                    'Niebieskie' => 'Niebieskie',
                    'Zielone' => 'Zielone',
                    'Piwne' => 'Piwne',
                    'Inne' => 'Inne'
                ]
            ])
            ->add('age', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Wiek',
            ])
            ->add('activate', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-success waves-effect mid'
                ],
            ])
        ;
    }
}