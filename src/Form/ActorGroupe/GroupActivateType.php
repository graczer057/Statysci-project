<?php

namespace App\Form\ActorGroupe;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;

class GroupActivateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Nazwa firmy'
            ])
            ->add('adres', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Adres firmy',

            ])
            ->add('telefon', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Numer telefony firmy',
            ])
            ->add('description', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Podaj opis firmy',
            ])
            ->add('activate', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-success waves-effect mid'
                ]
            ])
        ;
    }
}