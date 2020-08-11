<?php

namespace App\Form\User;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserActivateType extends AbstractType{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('height', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Wzrost'
            ])
            ->add('eyes', ChoiceType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Kolor oczu',
                'choices' => [
                    'Niebieskie' => 'Niebieskie',
                    'Zielone' => 'Zielone',
                    'Piwne' => 'Piwne'
                ]
            ]);
    }
}