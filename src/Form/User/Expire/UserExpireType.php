<?php

namespace App\Form\User\Expire;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class UserExpireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Email'
            ])
            ->add('expire', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-success waves-effect mid'
                ],
                'label' => 'Wyślij ponownie'
            ])
        ;
    }
}