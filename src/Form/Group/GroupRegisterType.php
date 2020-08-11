<?php

namespace App\Form\Group;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class GroupRegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Name of the group*'
            ])
            ->add('email', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Email*'
            ])
            ->add('nip', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'required' => false,
                'constraints' => [
                    new Length([
                        'min' => 10,
                        'max' => 10,
                        'minMessage' => 'NIP is longer',
                        'maxMessage' => 'NIP is shorter',
                    ]),
                ],
                'label' => 'NIP if you are a company (optional)'
            ])
            ->add('plainPassword', PasswordType::class, [
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
                'label' => 'Password*'
            ])
            ->add('description', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Description'
            ])
            ->add('save', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-success waves-effect mid'
                ],
                'label' => 'Register'
            ])
        ;
    }
}