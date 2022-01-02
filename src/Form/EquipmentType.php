<?php

namespace App\Form;

use App\Entity\Equipment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EquipmentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', \Symfony\Component\Form\Extension\Core\Type\TextType::class, [
                'label' => 'Nom',
                'required' => false,
            ])
            ->add('category', \Symfony\Component\Form\Extension\Core\Type\TextType::class, [
                'label' => 'Catégorie',
                'required' => false,
            ])
            ->add('number', \Symfony\Component\Form\Extension\Core\Type\TextType::class, [
                'label' => 'Numéro',
            ])
            ->add('description', \Symfony\Component\Form\Extension\Core\Type\TextareaType::class, [
                'label' => 'Déscription',
                'empty_data'    => '',
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Equipment::class,
        ]);
    }
}
