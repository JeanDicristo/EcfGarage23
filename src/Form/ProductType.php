<?php

namespace App\Form;

use App\Entity\Brand;
use App\Entity\Equipment;
use App\Entity\Product;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('name', TextType::class, [
            'attr' => [
                'class' => 'form-control',
                'placeholder' => 'Bmw ......'
            ],
            'label' => 'Nom',
            'label_attr' => ['class' => 'form-label mt-4'],
        ])
        ->add('price', NumberType::class, [
            'attr' => [
                'class' => 'form-control',
                'placeholder' => '10000 €'
            ],
            'label' => 'Prix',
            'label_attr' => ['class' => 'form-label mt-4'],
        ])
        ->add('year', TextType::class, [
            'attr' => [
                'class' => 'form-control',
                'placeholder' => 'Année mise en circulation',
                'min' => 2010,
                'max' => date('Y'),
                'step' => 1,
            ],
            'label' => 'Année',
            'label_attr' => ['class' => 'form-label mt-4'],
        ])
        ->add('mileage', TextType::class, [
            'attr' => [
                'class' => 'form-control',
                'placeholder' => 'Klm au compteur'
            ],
            'label' => 'Kilometre',
            'label_attr' => ['class' => 'form-label mt-4'],
        ])
        ->add('brand', EntityType::class, [
            'attr' => [
                'class' => 'form-control'
            ],
            'label' => 'Marque',
            'class' => Brand::class,
            'mapped' => false,
        ])
        ->add('equipment', EntityType::class, [
            'attr' => [
                'class' => 'form-control'
            ],
            'label' => 'Équipement',
            'class' => Equipment::class ,
            'choice_label' => 'name',
            'multiple' => true, // Permettre la sélection de plusieurs options si nécessaire
            'expanded' => true, // Afficher les options sous forme de cases à cocher si nécessaire
        ])
        // ->add('imageFile', VichImageType::class, [
        //     'label' => 'Image de la voiture',
        //     'label_attr' => [
        //         'class' => 'form-label mt-4'
        //     ],
        //     'required' => false
        // ])
        ->add('submit', SubmitType::class, [
            'attr' => [
                'class' => 'btn button-product mt-4'
            ],
            'label' => 'Enregistrer l\'offre'
        ])
    ;
}

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
