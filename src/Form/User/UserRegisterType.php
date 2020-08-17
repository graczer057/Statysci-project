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

class UserRegisterType extends AbstractType{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Adres email'
            ])
            ->add('login', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Nazwa użytkownika'
            ])
            ->add('plainPassword', PasswordType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        'max' => 4096,
                    ]),
                ],
                'label' => 'Hasło'
            ])
            ->add('role', ChoiceType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'choices' => [
                    'Kandydat' => 1,
                    'Grupa aktorska' => 2,
                    'Firma' => 3
                ],
                'label' => 'Rejestruję się jako'
            ])
            ->add('Register', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-success waves-effect mid'
                ],
                'label' => 'Zarejestruj się'
            ])
        ;
    }
}