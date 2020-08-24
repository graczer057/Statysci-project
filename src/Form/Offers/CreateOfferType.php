<?php


namespace App\Form\Offers;


use App\Entity\CandidateProfil\CandidateProfil;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class CreateOfferType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Tytuł'
            ])
            ->add('description', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Opis'
            ])
            ->add('growthMin', IntegerType::class,[
                'attr' =>[
                    'step'=>1,
                    'min' =>0,
                    'max'=>250,
                    'value'=>0,
                    'label'=>"Wzrost Minimalny"
                ],

            ])
            ->add('growthMax', IntegerType::class,[
                'attr' =>[
                    'step'=>1,
                    'min' =>0,
                    'max'=>250,
                    'value'=>250,
                    'label'=>"Wzrost Maxymalny"
                ]
            ])
            ->add('physique', ChoiceType::class, [
                'attr' => [
                    'class' => CandidateProfil::class,
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
                'choices' => [array_flip(CandidateProfil::HAIRLENGTHS),'Dowolna'=>'default'],
                'data'=>'default'
            ])
            ->add('hair_color', ChoiceType::class, [
                'attr' => [
                    'class' => CandidateProfil::class
                ],
                'label' => 'Kolor włosów',
                'choices' => [array_flip(CandidateProfil::HAIRCOLORS),'Dowolna'=>'default'],
                'data'=>'default'
            ])
            ->add('eye_color', ChoiceType::class, [
                'attr' => [
                    'class' => CandidateProfil::class
                ],
                'label' => 'Kolor oczu',
                'choices' => [array_flip(CandidateProfil::EYRCOLORS),'Dowolna'=>'default'],
                'data'=>'default'
            ])
            ->add('sex', ChoiceType::class, [
                'attr' => [
                    'class' => CandidateProfil::class
                ],
                'label' => 'Płeć',
                'choices' => [array_flip(CandidateProfil::SEX),'Dowolna'=>'default'],
                'data'=>'default'
            ])
            ->add('AgeMin', IntegerType::class,[
                'attr' =>[
                    'step'=>1,
                    'min' =>0,
                    'max'=>100,
                    'value'=>0,
                    'label'=>'Wiek Minimalny'
                ]
            ])
            ->add('AgeMax', IntegerType::class,[
                'attr' =>[
                    'step'=>1,
                    'min' =>0,
                    'max'=>100,
                    'value'=>100,
                    'label'=>'Wiek Maxymalny']
            ])
        ;
    }

}