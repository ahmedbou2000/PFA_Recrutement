<?php

namespace App\Form;

use App\Entity\Profil;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ProfilType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('experience', IntegerType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Experience',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ]
            ])
            ->add('details', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Details',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ]
            ])
            ->add('prixParHeure', MoneyType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Prix par heure',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ]
            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-info mt-4'
                ],
                'label' => 'Modifier le profile'
            ])
            ;
            
            
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Profil::class,
        ]);
    }
}
