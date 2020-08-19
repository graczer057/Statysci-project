<?php

namespace App\Form\User;

use App\Entity\CandidateProfil\CandidateProfil;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class UserActivateType extends AbstractType{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('growth', IntegerType::class,[
                'attr' =>[
                    'step'=>1,
                    'min' =>0,
                    'max'=>250,
                    'value'=>0
                ],
                'label' => 'Wzrost'
            ])
            ->add('physique', ChoiceType::class, [
                'attr' => [
                    'class' => CandidateProfil::class
                ],
                'label' => 'Sylwetka',
                'choices' => [array_flip(CandidateProfil::PHYSIQUES),'Dowolna'=>'default'],
                'data'=>'default'
            ])
            ->add('hair_length', ChoiceType::class, [
                'attr' => [
                    'class' => CandidateProfil::class
                ],
                'label' => 'Włosy',
                'choices' => [CandidateProfil::HAIRLENGTHS,'Dowolna'=>'default'],
                'data'=>'default'
            ])
            ->add('hair_color', ChoiceType::class, [
                'attr' => [
                    'class' => CandidateProfil::class
                ],
                'label' => 'Kolor włosów',
                'choices' => [CandidateProfil::HAIRCOLORS,'Dowolna'=>'default'],
                'data'=>'default'
            ])
            ->add('eye_color', ChoiceType::class, [
                'attr' => [
                    'class' => CandidateProfil::class
                ],
                'label' => 'Kolor oczu',
                'choices' => [CandidateProfil::EYRCOLORS,'Dowolna'=>'default'],
                'data'=>'default'
            ])
            ->add('age',IntegerType::class,[
                'attr' =>[
                    'step'=>1,
                    'min' =>0,
                    'max'=>100,
                    'value'=>0
                ],
                'label' => 'Wiek',
            ])
            ->add('activate', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-success waves-effect mid'
                ],
                'label' => 'Aktywuj'
            ])
        ;
    }
}