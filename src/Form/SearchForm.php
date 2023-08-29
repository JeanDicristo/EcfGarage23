<?php

namespace App\Form;

use App\Data\SearchData;
use App\Entity\Brand;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       $builder
       ->add('q', TextType::class, [
        'label' => false,
        'required' => false,
        'attr' => [
            'placeholder' => 'Rechercher'
        ]
        ])
        ->add('brands', EntityType::class, [
            'label' => false,
            'required' => false,
            'class' => Brand::class,
            'multiple' => true, // Permet la sélection de plusieurs marques
        ])
        ->add('min', NumberType::class, [
            'label' => false,
            'required' => false,
            'attr' => [
                'placeholder' => 'Prix min'
            ]
        ])
        ->add('max', NumberType::class, [
            'label' => false,
            'required' => false,
            'attr' => [
                'placeholder' => 'Prix max'
            ]
        ])
        ->add('mileage', RangeType::class, [
            'label' => false,
            'required' => false,
            'attr' => [
                'placeholder' => 'Kilometrage'
            ]
        ])
        ->add('promo', CheckboxType::class, [
            'label' => 'En promo',
            'required' => false,
        ])
        ;
    }

    public function configureOption(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SearchData::class,
            'method' => 'GET',
            'csrf_protection' => false
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }

}
